
## Introduction
I'm using the 9.0.1 version of the Microfocus COBOL compiler, which i found in the installation folder of Wingesfar.

By issuing 
```
ccbl32.exe -v
```
I'm getting:
```
License file 'C:\Users\Giacomo\Desktop\Patching ccbl32\901\ccbl32.alc' inaccessible
Micro Focus extend compiler version 9.0.1
Copyright (C) 1985-2010 Micro Focus (IP) Ltd.
```

which tells me that there is a license issue. Needless to say that if I try to compile a .cbl source file, the compiler stops right at the beginning showing the missing license error message.


## First dead end
sub_60048720 was very promising. It seemed like that if it returns 0 the license is not valid, while if it returns true the license is valid.
At the beginning of the function:
```
movsx   eax, word_600A86C0
test    eax, eax
jl      short loc_6004873D
```
which corresponds to:
```
  if ( word_600A86C0 >= 0 )
    return word_600A86C0;
```
word_600A86C0 is initialized in the .data section of the binary to 0xFFFF, which is -1 (two's complement).
This flag is set to either 0 or 1 by the logic of this function and acts as a cache so that if the function is called multiple times, the return value is computed only once, stored in this variable and returned immediately 
in subsequent calls of the functions.

So my idea was to simply change the .data section of the binary and replace the 0xFFFF with a 0x0001, which seemed like the value to return when the license check succeeds.
After doing so, the output of the program changed to:

```
ccbl32.exe -v
Micro Focus extend compiler version 9.0.1
Copyright (C) 1985-2010 Micro Focus (IP) Ltd.
```
Which looked super promising: no more inaccessible license error.
Unfortunately, this didn't solve the problem: no compilation was performed. The program just quit without showing any error message.

## Second attempt
I decided to look at the exit code and it still was 10, even after the patch above.

I then focued my attention to the point where the sub_60048720 function was beeing called.
When that function returns 0, a bit in a bitmask is cleared, as follows:
```
mov     eax, dword_600c4844
and     eax, 0FFFFFFFEh
mov     dword_600c4844, eax
```
...Maybe there's more to that bitmask

I'm not sure when in the code the bitmap is set. However I found a piece of code that checks if the last bit is set 
```
mov     eax, dword_600c4844 		| A1 44 48 0C 60
and     eax, 1						| 83 E0 01
jnz     short loc_600490DF			| 75 0A
mov     eax, 0Ah					| B8 0A 00  00 00
jmp     loc_6004A9C4				| E9 E5 18 00 00
```

loc_6004A9C4 is the end of the function. 0x0A is 10 in decimal, which is the returned value in case of the license error. The issue is that the license_bitmask has never the last bit set to one.
The idea here is to either skip the check of the bit or set the bit.

By changing the opcode from 75 to EB, the jnz becomes an unconditional jump, like so:
```
jmp     short loc_600490DF			| EB 0A
```
...and that did the trick.

To sum up, I patched the initial value of word_600A86C0 in order not to display the error message related to the license and then patched the jump instruction so that it ignored the result of the check of the bitmask.
If I only patch the jnz instruction, the program would still work, however the error message would still always appear


## Other patching ideas
Another way of patching the binary would be to avoid the call to the sub_60048720 function and set the last bit of the bitmask instead.
Let's have a look at that portion of the disassembler:
```
loc_60048A32:
lea     ecx, [ebp+var_448]			| 8D 8D B8 FB FF FF
push    ecx							| 51
call    sub_60048720				| E8 E2 FC FF FF
add     esp, 4						| 83 C4 04
test    eax, eax					| 85 C0
jnz     short loc_60048A61			| 75 1C

lea     edx, [ebp+var_448]			| 8D 95 B8  FB FF FF
push    edx 						| 52
call    sub_600356A0 				| E8 4F CC FE FF
add     esp, 4						| 83 C4 04
mov     eax, dword_600c4844 		| A1 44 48 0C 60
and     eax, 0FFFFFFFEh 			| 83 E0 FE
mov     dword_600c4844, eax 		| A3 44 48 0C 60

loc_60048A61: 
...
```
The idea is to insert the instructions to set the dword_600c4844 to 0x00000001 (maybe other bits have interesting meaning...) by replacing the first few instructions and then insert a nop slide in order to preserve the original size of the binary. The opcode of the nop instruction is 90.
One way to set dword_600c4844 to 1 could be the following:
```
xor     eax, eax				| 33 C0
inc     eax						| 40
mov     dword_600c4844, eax 	| A3 44 48 0C 60
```

And this worked too :P


## Things I learned

### Setting a register to 0
To set the return value (eax register) to zero, the compilers usually optimize it down to 
```
xor     eax, eax		| 33 C0
```
In case you want to return 1:
```
xor     eax, eax		| 33 C0
inc     eax				| 40
```
This beacuse the opcodes are shorter:
```
mov eax, 0 				|b8 00 00 00 00
```


### Get the exit code
```
echo Exit Code is %errorlevel%
```
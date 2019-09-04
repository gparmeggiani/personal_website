# Personal website
My personal website, where I collect my work and other things I believe are worth sharing.  
This is version 2.0, built in 2019

## Development
This website is built statically using Gulp. NPM is used to fetch the packages required both for the website itself (such as bootstrap) and for the build process (e.g. Gulp).

The build process takes the source files in the `src` directory and the necessary files form the `node_modules` directory and builds the `www` directory and its contents, according to what is defined in the `gulpfile.js`

### Install or update the Node modules
Install or update all the dependencies as follows:
```
npm install
```
or
```
npm update
```

### Run the development environment
```
npm run gulp dev
```
This will run the Gulp default task, which will build the `www` directory and a browser will load with its contents.  
In addition to that, the `src` folder will be watched for changes and the browser will automatically update its contents to reflect the new changes.

## Deploy
First al all, make sure to have the NPM modules installed. Otherwise run `npm install` or `npm update`  
To build the `www` directory, simply run
```
npm run gulp
```

At this point, copy the `www` folder to the web server root.

## TODO
- Fix double line text in header which makes the body jump up and down
- Fix links issues on mobile
- Fix portfolio pages layout for mobile
- Add canonical URL
- Add error pages: /error-pages/404.html
- Is <article> worth using?
- Test accessibility
- Test on iPhone (and friends) notch

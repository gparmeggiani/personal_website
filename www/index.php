<?php
    //compute my age
    $birthDate = DateTime::createFromFormat('d/m/Y', '07/02/1991');
    $age = $birthDate->diff(new DateTime('now'))->y;

    //List of my skills
    $skills = array();
    $skills[0] = "Electronics";
    $skills[1] = "Analog circuit design";
    $skills[2] = "Digital circuit design";
    $skills[3] = "Digital Signal Processing (DSP)";
    $skills[4] = "Entrepreneurship";
    $skills[5] = "Matlab";
    $skills[6] = "Java";
    $skills[7] = "C";
    $skills[8] = "C++";
    $skills[9] = "RTOS";
    $skills[10] = "FreeRTOS";
    $skills[11] = "Power Electronics";
    $skills[12] = "ARM Cortex-M";
    $skills[13] = "OrCAD";
    $skills[14] = "OrCAD Allegro";
    $skills[15] = "OrCAD Capture CIS";
    $skills[16] = "PSpice";
    $skills[17] = "Atmel AVR";
    $skills[18] = "Javascript";
    $skills[19] = "Microcontrollers";
    $skills[20] = "SQL";
    $skills[21] = "GIT";
    $skills[22] = "PHP";
    $skills[23] = "HTML";
    $skills[24] = "Objective-C";
    $skills[25] = "iOS app development";
    $skills[26] = "Android app development";
    $skills[32] = "Teamwork";
    $skills[33] = "Public speaking";
    $skills[34] = "Project management";
    $skills[35] = "Oscillators";
    $skills[36] = "Amazon AWS";
    $skills[37] = "Linux";
    $skills[38] = "System Administration";

    //List of my desired skills
    $desired_skills = array();
    $desired_skills[0] = "DSP";
    $desired_skills[1] = "MATLAB";
    $desired_skills[2] = "Simulink";
    $desired_skills[3] = "Embedded";
    $desired_skills[4] = "FPGA";
    $desired_skills[5] = "VHDL / Verilog";


    $bespecular_skills = array(4, 6, 20, 21, 22, 23, 24, 25, 26, 32, 33, 34, 36, 37, 38);
    $smart_anchor_skills = array(0, 1, 3, 5, 7, 8, 9, 10, 12, 19);
    $thesis_skills = array(0, 1, 2, 3, 5, 13, 14, 15, 16);
    $oscillator_skills = array(0, 1, 5, 13, 16, 35);
    $joule_thief_skills = array(0, 1, 35, 11, 16);
    $class_a_amp_skills = array(0, 1, 13, 16);

?>
<!--
    Yes, I wrote this myself.
        - Giacomo <giacomo.parmeggiani@gmail.com>
-->
<!DOCTYPE html>
<html>
    <head>
        <title>Giacomo Parmeggiani</title>

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="description" content="<?php echo $age;?> years old. Studied Electronics Engineering at Politecnico di Milano."/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>

        <link href='http://fonts.googleapis.com/css?family=Lato:100,300' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/css/materialize.min.css">
        <link rel="stylesheet" href="css/timeline.css">

	<script type="text/javascript" src="js/modernizr.js"></script>
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/js/materialize.min.js"></script>

        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

            ga('create', 'UA-41370362-2', 'freshcircuits.com');
            ga('send', 'pageview');

            $(document).ready(function(){
                $('.parallax').parallax();
            });
        </script>

        <style>

            header {
                background-color: #F6F6F6;
            }

            header .col {
                margin: 100px 0;
            }

            header #profile {
                width: 200px;
                height: 200px;
                border-radius: 50%;
                object-fit: cover;
            }

            header h1 {
                font-size: 3em;
                margin-top: 0;
                margin-bottom: 0;
            }

            header p {
                font-size: 1.3em;
                margin-bottom: 15px;
            }

            .section {
                font-size: 1.4em;
                margin: 30px auto;
                padding: 0 30px;
                text-align: justify;
            }

            @media only screen and (min-width: 768px) {
            /* screens bigger than 768px */
                .section {

                    width: 80%;
                    max-width: 1500px;

                }

                .section.with-columns {

                    -webkit-column-count: 2; /* Chrome, Safari, Opera */
                    -moz-column-count: 2; /* Firefox */
                    column-count: 2;
                }

            }
            parallax img {
                width: 100%;
                height: auto;
            }
            .pic-credit {
                text-align: right;
                padding: 20px;
                color: #666666;
                font-size: 0.6em;
            }

            h3 {
                font-size: 1.5em;
                text-align: center;
            }


            footer {
                height: 100%;
                color: white;
                text-shadow: 0 1px 0 black;
            }

            footer h1 {
                margin: 0;
                padding: 20px 0 60px;
                background: transparent;
                text-align: center;
                font-size: 3em;
            }
            footer .col {
                text-align: center;
            }


            /*SKILLS*/

            .skills-container {
                margin: 30px 0;
                text-align: left;
            }


            .skill {
                display: inline-block;
                border-radius: 25px;
                height: 50px;
                line-height: 50px;
                padding: 0 15px;
                margin: 5px;
                border: 1px solid #6600ff;
                color: #6600ff;
            }

            .skill:hover {
                background-color: #6600ff;
                color: white;
            }


            .skill.level0 {
                border: 1px solid #cc0000;
                color: #cc0000;
            }


            .skill.level0:hover {
                background-color: #cc0000;
                color: white;
            }

            /*END SKILLS*/

            .project-img {
                width: 100%;
                margin: 35px 0;
            }

            .project-img img {
                width: 100%;
                height: auto;
            }

            .project-img .caption {
                text-align: center;
                color: #666666;
                font-size: 0.8em;
            }

        </style>
    </head>
    <body>

        <header>
            <div class="row">
                <div class="col l2 offset-l3">
                    <img id="profile" src="img/giaco.jpg">
                </div>
                <div class="col l5 ">

                    <h1>Giacomo Parmeggiani</h1>
                    <p class="tagline">
                        Co-founder at <b>BeSpecular</b>, helping the blind<br>
                        <b>Electronics Engineering</b> M.Sc. at <b>PoliMi</b><br>
                        International management at <b>Stanford</b>
                    </p>
                    <p>
                        <a href="mailto:giacomo.parmeggiani@gmail.com">Email me</a> •
                        <a href="https://twitter.com/sonogiacomo" target="_blank">Twitter</a> •
                        <a href="https://www.linkedin.com/pub/giacomo-parmeggiani/66/621/407" target="_blank">Linkedin</a>
                    </p>
                </div>
            </div>
        </header>
        <div class="section white with-columns" id="bio">
            My name is <b>Giacomo</b> and <b>I was born with the passion for technology</b> and electronics: my mom used to make me homemade easter eggs filled with
            electrical wires, plugs and switches.
            My dad (who, btw, never had the passion for technology or electronics) also supported me and bought me my first soldering iron so
            that I could start soldering my first circuits, roughly at the age of ten.
            Also, when I was a kid, I tended to tear apart any electronic device because I really wanted to discover what there was inside. Those were my toys!<br>

            I grew up in Italy in a small town called Manzano (Udine) where I spent my free time designing and building electrical circuits and developing all sorts of software.
            This <b>passion</b> led me to enroll at <b>Polytechnic University of Milan</b>, where I first got my B.Sc. and then the M.Sc. in <b>Electronics Engineering</b>.<br>

            I'm also extremely passionate about creating things that people can use and seeing the impact that have on their lives.
            This brought me to <a href="http://summer.stanford.edu/" target="_blank">Stanford</a> for the summer 2014.
            There I studied <b>Technology Entrepreneurship</b> as part of an intensive studies program focused on <b>International Management</b>.
            During that summer, <a href="https://www.bespecular.com" target="_blank">BeSpecular</a> was born, which is an app to help <b>blind</b> people live a
            more independent life.<br>

            After having launched the app, i joined the team of <a href="http://www.azcom.it" target="_blank">Azcom</a> as a <b>LTE PHY DSP Engineer</b>.
            There I'm now also collaborating in the H2020 5G-PPP Project named <a href="http://5g-coral.eu/" target="_blank">5G-CORAL</a> by designing and
            developing the <b>connected cars</b> testbed which aims at demonstrating how the <b>Edge and Fog Computing</b> can help improve the <b>road safety</b>.
        </div>


        <div class="parallax-container">
            <div class="parallax">
                <img src="img/sea.jpg">
            </div>
        </div>
        <div class="section white">
            <div class="pic-credit">Picture: Me in Cape Town, South Africa (2015)</div>
            <h2>Skills</h2>
            <p>
            Here's a list of the most important skills I developed over the years. (random order)<br>
            <p>
            <div class='skills-container'>
                <?php

                foreach ($skills as $skillID => $skillName) {
                    echo "<div class=\"skill\" data-skillID=\"{$skillID}\">{$skillName}</div>";
                }

                ?>
            </div>

            <p>
            Here's a list of the skills I'd like to develop or improve in the future.<br>
            <p>
            <div class='skills-container'>
                <?php

                foreach ($desired_skills as $skillID => $skillName) {
                    echo "<div class=\"skill level0\" data-skillID=\"{$skillID}\">{$skillName}</div>";
                }

                ?>
            </div>
        </div>


        <div class="parallax-container">
            <div class="parallax">
                <img src="img/jim.jpg">
            </div>
        </div>
        <div class="section white">
            <div class="pic-credit">Picture: Jim Williams's schematic sketch for a barometric circuit, 1992. I took this Picture at the Computer History Museum in 2012</div>
            <h2>Projects</h2>
            <p>
                <!-- A little intro here. Explain why I decided to build some devices. No labs at our university -->
            </p>
            <div class="row">

                <div class="col l6">
                    <h3>BeSpecular</h3>
                    <p>
                        BeSpecular is an app that lets you help blind &amp; deafblind people identify objects or situations.
                    </p>
                    <p>
                        More info at <a href="https://www.bespecular.com" target="_blank">www.bespecular.com</a>
                    </p>

                    <div class="project-img">
                        <img src="img/bespecular_stanford_team.jpg">
                        <div class="caption">
                            The BeSpecular's original team at Stanford
                        </div>
                    </div>
                    <div class="project-img">
                        <img src="img/bespecular_stanford_park.jpg">
                        <div class="caption">
                            The BeSpecular's original team and the teachers of the Technology Entrepreneurship class at Stanford
                        </div>
                    </div>
                    <div class="project-img">
                        <img src="img/bespecular_TC.jpg">
                        <div class="caption">
                            TechCrunch Disrupt, London 2014
                        </div>
                    </div>
                    <div class="project-img">
                        <img src="img/bespecular_striscia.jpg">
                        <div class="caption">
                            Interview on Striscia la Notizia, a popular italian TV show. Italy, 2016
                        </div>
                    </div>
                    <div class="project-img">
                        <img src="img/bespecular_acb.jpg">
                        <div class="caption">
                            American Council of the Blind, Minneapolis 2016
                        </div>
                    </div>
                    <div class="project-img">
                        <img src="img/bespecular_users.png">
                        <div class="caption">
                            Our users around the world. VIP: Visually Impaired Person, S: Sighted
                        </div>
                    </div>

                    <div class='skills-container'>
                        <?php

                            foreach ($bespecular_skills as $skillID) {

                                $skillName = $skills[$skillID];

                                echo "<div class=\"skill\" data-skillID=\"{$skillID}\">{$skillName}</div>";
                            }

                        ?>
                    </div>
                </div>
                <div class="col l6">
                    <h3>Smart Anchor</h3>
                    <p>
                        SmartAnchor is a device that tells you if a boat anchor is dragging or not by detecting its vibrations. This provides the skipper with one more tool that allows him to stay more relaxed if spending the night at anchor. I've done several tests with a device attached on an anchor and linked to the boat via a cable. The first figure shows an example of a measurement.
                        I first devised a system that allows to correctly process the data and trigger an alarm in case of a detection of some vibrations. It computes the RMS value of acceleration over the three axes, then a derivative is computed to detect sudden changes of gravity. This is followed by a low pass filtering and a Schmitt trigger.
                        I'm currently working on the communication between the device and the boat and ultrasonic waves seem like to only option. I built a fully software DBPSK modulator running on the device attached to the anchor. The demodulation is again fully software and uses a Costas loop to reconstruct the carrier frequency (non coherent demodulation). So far it has only been implemented in MATLAB, but using real data that has been transmitted over ultrasonic waves from one side of the room to the other. The last figure shows the demodulation process.
                    </p>
                    <div class="project-img">
                        <img src="img/smart_anchor_measure.png">
                        <div class="caption">
                            Vibrations measured by the accelerometer attached to the anchor.
                        </div>
                    </div>
                    <div class="project-img">
                        <img src="img/smart_anchor_transmitter.jpg">
                        <div class="caption">
                            The device to be attached to the anchor. The communication on this prototype is done through UART
                        </div>
                    </div>
                    <div class="project-img">
                        <img src="img/smart_anchor_DBPSK_demod.png">
                        <div class="caption">
                            Tests on DBPSK demodulation
                        </div>
                    </div>

                    <div class='skills-container'>
                        <?php

                            foreach ($smart_anchor_skills as $skillID) {

                                $skillName = $skills[$skillID];

                                echo "<div class=\"skill\" data-skillID=\"{$skillID}\">{$skillName}</div>";
                            }

                        ?>
                    </div>
                </div>

            </div>
            <div class="row">

                <div class="col l6">
                    <h3>M.Sc. Thesis</h3>
                    <p>
                        My thesis work consists in the design, creation and test of the readout electronics for a digital sensor for X-ray radiography using organic pixels. It consists of a matrix of pixels, each having a photodetector and an addressing diode, both fabricated by only using soluble processed conductors, insulators and semiconductors deposited by an InkJet machine. Thanks to the peculiar deposition process that allows to operate at almost room temperature, this technology is well suited to plastic substrates, thus targeting lightweight, flexible and non-fragile electronic devices and systems.
                    </p>
                    <div class="project-img">
                        <img src="img/thesis-organic-matrix.jpg">
                        <div class="caption">
                            A test 6x6 matrix made with organic devices
                        </div>
                    </div>
                    <div class="project-img">
                        <img src="img/thesis-readout.jpg">
                        <div class="caption">
                            The readout circuit I built to read the signals from the matrix. The matrix is mounted on its holder
                        </div>
                    </div>
                    <div class="project-img">
                        <img src="img/thesis-transfercurve-no-calibration.png">
                        <div class="caption">
                            Transfer curve prior to calibration
                        </div>
                    </div>
                    <div class="project-img">
                        <img src="img/thesis-transfercurve-calibrated.png">
                        <div class="caption">
                            Transfer curve after calibration.<br>
                            It is very linear and the noise starts to become an issue for charges less than ~15fC
                        </div>
                    </div>

                    <div class='skills-container'>
                        <?php

                            foreach ($thesis_skills as $skillID) {

                                $skillName = $skills[$skillID];

                                echo "<div class=\"skill\" data-skillID=\"{$skillID}\">{$skillName}</div>";
                            }

                        ?>
                    </div>
                </div>

                <div class="col l6">
                    <h3>Cross coupled oscillator</h3>
                    <p>
                        This circuit is an oscillator and it generates a sinusoidal waveform. Oscillators are circuits that always fascinated me: they can generate a signal on their own, starting from a DC power supply.
                        This particular circuit is based on the classic LC resonant tank. The LC circuit will naturally oscillate at its resonant frequency, but the oscillations will be dumped primarily because of
                        the parasitic resistance of the coil. The idea behind this circuit is to place in parallel with the LC circuit a negative resistance that, in parallel with the parasitic one, will cancel the
                        latter one out, resulting in an equivalent "infinite" impedance.
                        Of course, things are much more complicated. I conducted a deep study on this circuit, in particular I used the shooting method (implemented by myself in MATLAB) to accurately compute the oscillation period.
                        The study can be found <a href="CrossCoupledOscillatorStudy_ITA.pdf" target="_blank" hreflang="it">here</a> (Italian).
                    </p>

                    <div class="project-img">
                        <img src="img/cross_coupled.JPG">
                        <div class="caption">
                        </div>
                    </div>
                    <div class="project-img">
                        <img src="img/cross_coupled_spectrum.png">
                        <div class="caption">
                        </div>
                    </div>
                    <div class="project-img">
                        <img src="img/cross_coupled_time_domain.png">
                        <div class="caption">
                        </div>
                    </div>

                    <div class='skills-container'>
                        <?php

                            foreach ($oscillator_skills as $skillID) {

                                $skillName = $skills[$skillID];

                                echo "<div class=\"skill\" data-skillID=\"{$skillID}\">{$skillName}</div>";
                            }

                        ?>
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col l6">
                    <h3>Joule Thief</h3>
                    <p>
                        A Joule Thief is a circuit used to elevate a small DC voltage to a much higher AC voltage.
                        Compared to the classic circuit, the one I built has been modified in order to power a small neon lamp instead of a LED. The neon lamp requires about 160V to ionize the gas it contains
                        and therefore to produce light. Since this voltage cannot be present across the Collector and the Emitter pins of the BJT without burning it, I had to make a little modification to the transformer,
                        adding to it an additional winding connected directly to the neon lamp. This way the voltage will rise both across the neon lamp and the C and E of the transistor, but at two different rates,
                        according to the respective number of loops of the two windings. The voltage across the neon lamp will reach the required 160V before the VCE reaches the breakdown voltage.
                        This circuit fascinates me because it is a boost DC DC converter that also oscillates by itself, exploiting the nonlinearity of the magnetic core.
                    </p>

                    <div class="project-img">
                        <img src="img/joule_thief.jpg">
                        <div class="caption">
                        </div>
                    </div>

                    <div class='skills-container'>
                        <?php

                            foreach ($joule_thief_skills as $skillID) {

                                $skillName = $skills[$skillID];

                                echo "<div class=\"skill\" data-skillID=\"{$skillID}\">{$skillName}</div>";
                            }

                        ?>
                    </div>
                </div>

                <div class="col l6">
                    <h3>Class A amplifier</h3>
                    <p>
                        During my Bachelor's degree my friend <a href="https://www.linkedin.com/in/giacomo-petracca-94a0426a" target="_blank">Giacomo Petracca</a> and I decided to build some of the circuits we studied in class.
                        The first one we build was a (bulky) class A amplifier, and it has been the first non trivial circuit I have ever designed and not just built or modified.
                        Hearing the music coming out of the loudspeaker connected to it was a big satisfaction!
                    </p>

                    <div class="project-img">
                        <img src="img/classA-amplifier.jpg">
                        <div class="caption">
                        </div>
                    </div>

                    <div class='skills-container'>
                        <?php

                            foreach ($class_a_amp_skills as $skillID) {

                                $skillName = $skills[$skillID];

                                echo "<div class=\"skill\" data-skillID=\"{$skillID}\">{$skillName}</div>";
                            }

                        ?>
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col l6">
                    <h3>One of my first circuits</h3>
                    <p>
                        This is one of my favorite pictures of when I was a kid.
                        That is me showing my mother a simple circuit I built. I guess that was to show the difference between two lamps connected in series or parallel.
                        In fact, the two at the back of the picture are connected in series and are less bright than the closest one, which is connected in parallel to the other two.
                    </p>

                    <div class="project-img">
                        <img src="img/me-4-years-old.jpg">
                        <div class="caption">
                        </div>
                    </div>
                </div>

                <div class="col l6">
                    <h3></h3>
                    <p>

                    </p>
                </div>
            </div>
        </div>


        <div class="parallax-container">
            <div class="parallax">
                <img src="img/giaco_pd.jpg">
            </div>
        </div>
        <div class="section white">
            <div class="pic-credit">Picture: Me presenting BeSpecular at a Pitch&amp;Drink in Milan (2015)</div>
            <h2>Timeline</h2>

            <section id="cd-timeline">
                <div class="cd-timeline-block">
                    <div class="cd-timeline-img"></div>
                    <div class="cd-timeline-content">
                        <h2>DSP Software Engineer</h2>
                        <p>
                            In January 2017 I started working as a DSP Software Engineer at <a href="http://www.azcom.it" target="_blank">Azcom</a>.<br>
                            - NB-IoT PHY DSP development<br>
                            - LTE PRACH Format 2 (MATLAB + DSP)<br>
                            - 5G-CORAL Connected Cars testbed<br>
                        </p>
                        <span class="cd-date">2016</span>
                    </div>
                </div>

                <div class="cd-timeline-block">
                    <div class="cd-timeline-img"></div>
                    <div class="cd-timeline-content">
                        <h2>M.Sc. at Politecnico di Milano</h2>
                        <p>
                            Graduated (110/110) in Electronics Engineering at <a href="http://www.polimi.it" target="_blank">PoliMi</a>.
                        </p>
                        <span class="cd-date">2016</span>
                    </div>
                </div>

                <div class="cd-timeline-block">
                    <div class="cd-timeline-img"></div>
                    <div class="cd-timeline-content">
                        <h2>Started BeSpecular</h2>
                        <p>
                            During a class at Stanford, my team and I created BeSpecular.<br>
                            Then, <a href="https://twitter.com/stephcowper_sa" target="_blank">Stephanie Cowper</a> and I carried on the project. I took care of the technology (entire development of the server side code, iOS and Android app)
                        </p>
                        <span class="cd-date">2014</span>
                    </div>
                </div>

                <div class="cd-timeline-block">
                    <div class="cd-timeline-img"></div>
                    <div class="cd-timeline-content">
                        <h2>Summer School at Stanford</h2>
                        <p>
                            I went to Stanford for a Summer School on Technology Entrepreneurship.<br>
                            What I liked the most? The AMAZING people from all over the World that I met there
                        </p>
                        <span class="cd-date">2014</span>
                    </div>
                </div>

                <div class="cd-timeline-block">
                    <div class="cd-timeline-img"></div>
                    <div class="cd-timeline-content">
                        <h2>B.Sc. at Politecnico di Milano</h2>
                        <p>I started the Bachelor of Science in Electronics Engineering at <a href="http://www.polimi.it" target="_blank">PoliMi</a>.</p>
                        <span class="cd-date">2010</span>
                    </div>
                </div>

                <div class="cd-timeline-block">
                    <div class="cd-timeline-img"></div>
                    <div class="cd-timeline-content">
                        <h2>Started High School</h2>
                        <p>Istituto Bertoni (Udine)</p>
                        <span class="cd-date">2005</span>
                    </div>
                </div>
            </section>
        </div>
        <div class="parallax-container">
            <div class="parallax">
                <img src="img/rock.jpg">
            </div>
            <footer>
                <h1>Giacomo Parmeggiani</h1>
                <div class="row">
                    <div class="col s10 l5 offset-s1 offset-l1">
                        Send me an email: <a href="mailto:giacomo.parmeggiani@gmail.com">giacomo.parmeggiani@gmail.com</a>
                    </div>
                    <div class="col s10 l5">
                        "Let’s not pretend that things will change if we keep doing the same things.<br>
                        A crisis can be a real blessing to any person, to any nation. For all crises bring progress. [...]<br>
                        He who blames his failure to a crisis neglects his own talent and is more interested in problems than in solutions. [...]<br>
                        There’s no challenge without a crisis. Without challenges, life becomes a routine, a slow agony.
                    </div>
                </div>
            </footer>
        </div>
    </body>
</html>

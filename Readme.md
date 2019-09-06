# Personal website
My personal website, where I collect my work and other things I believe are worth sharing.  
Version 2.x, built in late 2019

## Development
This is a static website built using Gulp.  
NPM is used to fetch the packages required both for the website itself (such as bootstrap) and for the build process (e.g. Gulp).

The build process takes the source files in the `src` directory and the necessary files form the `node_modules` directory and builds the `www` directory and its contents, according to what is defined in the `gulpfile.js`. This builds and minifies the JS and CSS files and builds the HTML pages from the mustache template files and data JSON files. 

### Install or update the Node modules
Install or update all the dependencies as follows:
```
npm install
npm update
```

### Run the development environment
```
npm run gulp dev
```
This runs the Gulp default task, which will build the `www` directory. Also, a browser opens up with its contents.  
In addition to that, the `src` folder will be watched for changes and the browser will automatically update its contents to reflect the new changes.

## Deploy
First of all, make sure to have the NPM modules installed. Otherwise run `npm install` or `npm update`  
To build the `www` directory, simply run
```
npm run gulp
```

At this point, copy the `www` folder to the web server root.

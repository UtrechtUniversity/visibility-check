

#Index
 1. Introduction
 2. Technology stack
 3. Configuration
 4. API URL
 5. Development HOWTO
 6. User session notes
 7. App configuration
 8. Available Scripts details
 9. Learn More

## Introduction
The Visibility Check is an online survey tool that help researcher to self asses their online visibility.

## Technology Stack

This app uses a front end made in Javascript (REACT) and a backend in PHP/Mysql 

**Frontend used the following frameworks**
- https://material-ui.com/  (UI)  
- https://reactjs.org/ (JS FW) 

**Backend used the following frameworks**
- https://www.php.net/ (PHP)
- https://www.mariadb.com/ (DB)
- laravel (PHP FW)


## Configuration
These variable can be configured depending on the running environment:

- **FEEDBACK_FORM_URL** : The Url of the external feedback form 

- **API_URL** : The url of the API that serves the questions and stores the answers

When executing the app with docker compose, these variables are injected into the container environment.

When running the app locally for developmen with nodejs these variable are read from the .env file directly

### API URL
The API is served by the **vcadmin** app (https://vcadmin.library.uu.nl/api) and is accessed with the help of a php proxy: 
- The proxy script is in **public/api.php**

The proxy can be configured for the following parameters:
  - **Allowed resources**: which endpoint can be called
  - **url**: the target url of the vcadmin api
  - **proxy**: if you want to use a socks5 proxy, useful during development


## Development HOWTO

The app can be developed locally using nodejs development server that **rebuilds and serves** the frontend automatically 
every time files of the frontend get saved to disk. 
The api_proxy can be server by a php development server

1. Install nodejs and php 

2. install js application libraries
   ```$ npm install```

3. Set environment variable used by the proxy in .env.development: 

    ` export API_URL='https://vcadmin-dev.library.uu.nl/api'`

4. start the local php proxy 

    `$ php -S localhost:9000 -t public`
   1. if needed, you can modify the value of the API_URL in .env.development
   
6. Start the node server `$ npm start`

7. Do your development, (the server is auto updated on every changed that is saved)


## User session and progress notes

![Session logic](docs/Session-Logic.png)


## App Configuration

There app loads the configuration in **two ways**:
When you run a local **node** server: 
- the node configuration is loaded from the `.env.development` file 
When the app runs on the webserver (apache).
- the configuration is read from apache environment variables and loaded by the public/env.js.php file

The **src/helpers/Config.js** class detects the right configuration to use 



## NPM Scripts details

In the project directory, you can run:

### `npm start`

Runs the app in the development mode.<br />
Open [http://localhost:3000](http://localhost:3000) to view it in the browser.

The page will reload if you make edits.<br />
You will also see any lint errors in the console.

### `npm test`

Launches the test runner in the interactive watch mode.<br />
See the section about [running tests](https://facebook.github.io/create-react-app/docs/running-tests) for more information.

### `npm run build`

Builds the app for production to the `docs` folder.<br />
It correctly bundles React in production mode and optimizes the build for the best performance.

The build is minified and the filenames include the hashes.<br />
Your app is ready to be deployed!

See the section about [deployment](https://facebook.github.io/create-react-app/docs/deployment) for more information.

### `npm run eject`

**Note: this is a one-way operation. Once you `eject`, you can’t go back!**

If you aren’t satisfied with the build tool and configuration choices, you can `eject` at any time. This command will remove the single build dependency from your project.

Instead, it will copy all the configuration files and the transitive dependencies (Webpack, Babel, ESLint, etc) right into your project so you have full control over them. All of the commands except `eject` will still work, but they will point to the copied scripts so you can tweak them. At this point you’re on your own.

You don’t have to ever use `eject`. The curated feature set is suitable for small and middle deployments, and you shouldn’t feel obligated to use this feature. However we understand that this tool wouldn’t be useful if you couldn’t customize it when you are ready for it.



## Learn More

You can learn more in the [Create React App documentation](https://facebook.github.io/create-react-app/docs/getting-started).


/**
 * Configuration fetcher
 *
 * during local development we don't have apache and the app makes use of the
 * REACT_APP_XXXX environment variables made available by process.env
 *
 * those variable are declared in .env.development
 *
 * @param name
 * @returns {string|*}
 */
function Config(name){

  if(process.env[`REACT_APP_${name}`]) {
    return process.env[`REACT_APP_${name}`]
  }
  return window._env[name];
}

export default Config;

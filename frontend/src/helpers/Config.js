/**
 * Configuration fetcher
 *
 *
 * @param name
 * @returns {string|*}
 */
function Config(name) {

  return process.env[`REACT_APP_${name}`];

}

export default Config;

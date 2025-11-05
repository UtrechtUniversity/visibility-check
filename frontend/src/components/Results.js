import React, {useEffect, useState} from "react";
import {Container, Paper} from "@material-ui/core";
import LinearProgress from "@material-ui/core/LinearProgress";
import withStyles from "@material-ui/core/styles/withStyles";
import {lighten} from "@material-ui/core/styles";
import Api from './Api';
import Button from "@material-ui/core/Button";
import Config from "../helpers/Config";

import spinner from '../spinner.gif';


const ColoredLinearProgress = withStyles({
  root: {
    height: 10,
    backgroundColor: lighten('#ccc', 0.5),
  },
  bar: {
    // borderRadius: 20,
    backgroundColor: props => props.linecolor,
  },
})(LinearProgress);

const styles = theme => ({
  root: {
    flexGrow: 1,
  },
  margin: {
    margin: theme.spacing(1),
  },
  maincont: {
    marginTop: 30
  },
  topicResult: {
    marginBottom: 5,
    height: 40
  },
  percResult: {
    fontSize: 11
  },
  error: {
    color: 'red'
  },
  loading: {
    textAlign: 'center',
    padding: 50,
    height: 225,
  }
});

/**
 * Resuts page
 *
 * @param classes
 * @returns {JSX.Element}
 * @constructor
 */
function Results({classes}) {

  const feedbackFromUrl = Config('FEEDBACK_FORM_URL');

  return (
    <Container maxWidth="sm" className={classes.maincont}>
      <Paper>
        <p><b>You have completed the check. Below you will find your score.</b></p>

        <ResultsInfo classes={classes} />

        <p>The check helps you to gain insight into the extent of your academic visibility.
          Practical tips and advice can be found on <a
            href="https://www.uu.nl/en/university-library/advice-support-for/researchers/visibility-check/visibility-to-do-list"
            target="_blank" rel="noopener noreferrer">the to-do list</a>.</p>
        <p>It could be that you have a specific question you need answered.
          If so, feel free to request a consultation with our team. Leave your details below and let us know what you
          need.</p>


        <div align='center'>
          <Button
            variant="contained"
            color="primary"
            target="_blank"
            rel="noopener noreferrer"
            href={feedbackFromUrl}
          >
            Contact us
          </Button>
        </div>
      </Paper>
    </Container>

  );

}

/**
 * Displays the results visual info
 *
 * @param classes
 * @returns {JSX.Element}
 * @constructor
 */
function ResultsInfo({classes}) {

  const [error, setError] = useState(false);
  const [results, setResults] = useState([]);

  useEffect(() => {
    Api().getResults()
      .then((response) => {
        setResults(response.data);
      })
      .catch(() => {
        setError(true);
      });
  }, [])

  if (results.length === 0) return  (
  // if (true) return  (
    <div className={classes.loading}>
      <img src={spinner} alt="loading..."/>
      <h3>Loading results...</h3>
    </div>
  );

  if (error) return (<p className={classes.error}>
    There was an error calculating your results, please contact us or try again ater.
  </p>);

  return (
    <>
      { results.map((topic, index) => <ResultsBar key={index} topic={topic} classes={classes}/>) }
    </>
  )
}


/**
 * Displays a single results bar
 *
 * @param topic
 * @param classes
 * @returns {JSX.Element}
 * @constructor
 */
function ResultsBar({topic, classes}) {

  const {answersCount, maxAnswers, info} = topic;
  const score = (answersCount / maxAnswers) * 100;
  const color = 'green';

  return (
    <div className={classes.topicResult}>
      <b>{info}</b> <span className={classes.percResult}>({Math.round(score)}%)</span>
      <ColoredLinearProgress
        linecolor={color}
        // className={classes.margin}
        variant="determinate"
        value={score}
        color="primary"
      />
    </div>
  );
}

export default withStyles(styles)(Results);
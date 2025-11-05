import React from "react";
import Typography from "@material-ui/core/Typography";
import {AppBar} from "@material-ui/core";
import withStyles from "@material-ui/core/styles/withStyles";
import Grid from "@material-ui/core/Grid";
import FeedbackIcon from '@material-ui/icons/Feedback';
import Button from "@material-ui/core/Button";
import Config from "../helpers/Config";

const styles = (theme) => ({
  bold: {
    color: '#FFCD00'
  },
  footer: {
    top: 'auto',
    bottom: 0,
    backgroundColor: 'black',
    padding: 10,
    [theme.breakpoints.down('xs')]: {
      padding: 8,
      paddingBottom: 5,
    },
    color: 'white'
  },
  title: {
    fontSize: 11
  },
  cc: {
    order: 1,
    textAlign: 'right',
    [theme.breakpoints.down('xs')]: {
      textAlign: 'center',
      order: 1,
      display: 'none'
    },
  },
  credits: {
    order: 2,
    "& .feedback-btn": {
      display: 'none'
    },
    [theme.breakpoints.down('xs')]: {
      order: 3,
      "& .feedback-btn": {
        display: 'inline-flex',
        height: '24px', marginLeft: '18px', fontSize: 11
      }
    },
  },
  feedback: {
    order: 3,
    [theme.breakpoints.down('xs')]: {
      textAlign: 'center',
      order: 2,
      display: 'none'
    },
  }
});


/**
 *
 * @returns {JSX.Element}
 */
function Footer({classes}) {

  const feedbackFromUrl = Config('FEEDBACK_FORM_URL');

  return (
    <AppBar position="fixed" color="primary" className={classes.footer}>

      <Grid container
            justifyContent="space-between"
            spacing={3}
            alignItems="flex-start"
      >
        <Grid item sm={3} xs={6} className={classes.cc}>
          <Typography>
            <a target="_blank" rel="noopener noreferrer" href="https://creativecommons.org/licenses/by-nc-sa/2.0/">
              <img src="/by-nc-sa.eu.png" width="80" alt="CC by-na-sa"/>
            </a>
          </Typography>
        </Grid>
        <Grid item sm={6} xs={12} className={classes.credits}>
          <Typography align={"center"} className={classes.title} variant="body1" gutterBottom>
            This tool, devised by <b className={classes.bold}>Iris van der Knaap</b> & <b
            className={classes.bold}>Dafne Jansen</b>, is licensed under <strong>CC BY-NC-SA</strong>.
            <Button
              className="feedback-btn"
              variant="contained"
              color="primary"
              size="small"
              startIcon={<FeedbackIcon/>}
              target="_blank"
              rel="noopener noreferrer"
              href={feedbackFromUrl}
            >
              Feedback
            </Button>
          </Typography>
        </Grid>
        <Grid item sm={3} xs={6} className={classes.feedback}>
          <Button
            className="feedback-btn"
            variant="contained"
            color="primary"
            size="small"
            startIcon={<FeedbackIcon/>}
            target="_blank"
            rel="noopener noreferrer"
            href={feedbackFromUrl}
          >
            Feedback
          </Button>
        </Grid>
      </Grid>
    </AppBar>
  )

}

export default withStyles(styles)(Footer);
import React, {useContext, useState} from 'react';
import Paper from "@material-ui/core/Paper";
import {
  Button,
  Checkbox,
  Container,
  Dialog,
  DialogActions,
  DialogContent,
  FormLabel
} from "@material-ui/core";
import makeStyles from "@material-ui/core/styles/makeStyles";
import {Link} from "react-router-dom";
import {SurveyDataContext} from "./SurveyDataContext";
import DialogContentText from "@material-ui/core/DialogContentText";
import Config from "../helpers/Config";


const useStyles = makeStyles(theme => ({

  paper: {
    minheight: 340,
    padding: 10,
    marginBottom: 12,
    elevate: 0
  },
  introbanner: {
    backgroundColor: "#309f84"
  },
  introimg: {
    height: 200,
    [theme.breakpoints.down('xs')]: {
      height: 130,
    },
  },
  privacyLabel: {
    color: "black",
    textDecoration: "underline"
  }


}));


/**
 *
 * @returns {JSX.Element}
 */
function Intro() {

  const feedbackFromUrl = Config('FEEDBACK_FORM_URL');

  const classes = useStyles();

  const {questions} = useContext(SurveyDataContext);
  const [open, setOpen] = useState(false);
  const [checked, setChecked] = useState(false);

  const openModal = () => {
    setOpen(true);
  };

  const closeModal = () => {
    setOpen(false);
  };

  function handleCheck(event) {
    setChecked(event.target.checked)
  }

  if (questions.length === 0) return <h3 className={'center'}>..loading</h3>

  return (
    <div>
      <Container className={classes.introbanner} maxWidth={false}>
        <div align='center'>
          <img className={classes.introimg} src='Visibility_Check_logo.jpg' alt="Logo Visibility Check"/>
        </div>
      </Container>
      <Container maxWidth="sm">
        <Paper>
          <p>The Visibility Check provides you with insight into the extent of your academic outreach. Moreover,
            it gives advice on how to generate more attention for your academic work and professional career.</p>
          <p>
            Do you see room for improvement? Any tips? <a href={feedbackFromUrl}
                                                          target="_blak"
                                                          rel="noopener noreferrer">Tell us what you think</a>
          </p>
        </Paper>
        <Paper>
          <Checkbox
            checked={checked}
            onChange={handleCheck}
            inputProps={{'aria-label': 'primary checkbox'}}
          />
          <FormLabel
            color="primary"
            onClick={openModal}
            className={classes.privacyLabel}
          >
            I have read the Privacy Statement
          </FormLabel>

          {/*<span onClick={openModal}>I have read the Privacy Statement </span>*/}
        </Paper>
        <PrivacyDialog open={open} handleClose={closeModal}/>
        <div align='center'>
          <Button color="primary"
                  variant="contained"
                  component={Link}
                  to={`/check/${questions[0].url}`}
                  disabled={!checked}
          >
            Start the check
          </Button>
        </div>
      </Container>
    </div>

  );

}


function PrivacyDialog({open, handleClose}) {
  return (
    <Dialog
      open={open}
      onClose={handleClose}
      aria-labelledby="Privacy Statement"
      aria-describedby="Visibility Check Privacy Policy declaration"
    >
      {/*<DialogTitle id="alert-dialog-title">{"Use Google's location service?"}</DialogTitle>*/}
      <DialogContent>
        <DialogContentText id="alert-dialog-description">
          If you use the Visibility Check, Utrecht University processes your personal data to generate a score on the
          results page. To evaluate and further improve our services, your personal data may be stored for up to one
          year.
          The processing of your personal data in this context takes place for the performance of a task carried out
          in the public interest.
          <br/>
          <br/>
          More information about the processing of your personal data can be found in the <a
          href="https://www.uu.nl/en/organisation/privacy-statement-utrecht-university"
          target="_blak"
          rel="noopener noreferrer">Utrecht University policy</a>.
        </DialogContentText>
      </DialogContent>
      <DialogActions>
        <Button onClick={handleClose} color="primary" variant="contained" autoFocus>
          Close
        </Button>
      </DialogActions>
    </Dialog>
  )
}


export default Intro;
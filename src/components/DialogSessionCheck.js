import Dialog from "@material-ui/core/Dialog";
import DialogTitle from "@material-ui/core/DialogTitle";
import DialogContent from "@material-ui/core/DialogContent";
import DialogContentText from "@material-ui/core/DialogContentText";
import DialogActions from "@material-ui/core/DialogActions";
import Button from "@material-ui/core/Button";
import React, {useContext, useEffect, useState} from "react";
import {SurveyDataContext} from "./SurveyDataContext";
import {createBrowserHistory} from "history";
import { useNavigate } from "react-router-dom";


/**
 *
 * @param openedQuestion
 * @returns {JSX.Element}
 * @constructor
 */
function DialogSessionCheck({openedQuestion}) {

  let history = createBrowserHistory();
  let navigate = useNavigate();

  const [open, setOpen] = useState(false);
  const {questions, setQuestions, user} = useContext(SurveyDataContext);

  /**
   * When there is a user
   */
  useEffect(() => {
    if (user && user.answers.length > 0 && openedQuestion.id !== questions[0].id) {
      setOpen(true);
    }
  }, [user]);


  /**
   * Continue last used user session
   *
   * @param reloadState
   */
  const continueSession = (reloadState) => {

    if (reloadState) {
      // Fill history and Go to last answered question// Load user answers
      fillAnswersHistory();
    } else {
      // Go to page 1
      const first = questions[0];
      navigate('/check/' + first.url);
    }
    setOpen(false);
  };

  /**
   * Fill user session and browser history with the list
   * of the already given answers
   *
   * TODO remove answers from questions
   *
   * @param answers
   */
  function fillAnswersHistory(answers) {
    // Fill answers in questions
    for (let a of user.answers) {
      questions.map(q => {
        if (q.id === a.question_id) {
          q.value.push(a.value);
        }
        return q;
      });
    }
    // Fill history
    let currentReached = false;
    const updatedQ = questions.map(q => {
      if (!currentReached && q.value.length ) {
        currentReached = (openedQuestion.id === q.id);
        history.push('/check/' + q.url);
      }
      return q;
    });
    setQuestions(updatedQ);
  }


  return (
    <Dialog open={open}
            aria-labelledby="alert-dialog-title"
            aria-describedby="alert-dialog-description" >
      <DialogTitle id="alert-dialog-title">{"Start again?"}</DialogTitle>
      <DialogContent>
        <DialogContentText id="alert-dialog-description">
          Looks like you have already answered some of the questions.
          Do you want to pick up where you left off or start the check again?
        </DialogContentText>
      </DialogContent>
      <DialogActions>
        <Button onClick={() => continueSession(true)} color="primary" variant="contained">
          Continue
        </Button>
        <Button onClick={() => continueSession(false)} color="primary" variant="contained">
          Start again
        </Button>
      </DialogActions>
    </Dialog>);
}

export default DialogSessionCheck;
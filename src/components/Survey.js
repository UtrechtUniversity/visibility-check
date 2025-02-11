import React, {useContext} from 'react';
import Question from './Question';
import {Box, Container, Paper} from "@material-ui/core";
import withStyles from "@material-ui/core/styles/withStyles";
import LinearProgress from "@material-ui/core/LinearProgress";
import {Navigate, useParams} from "react-router-dom";
import DialogSessionCheck from "./DialogSessionCheck";
import ButtonNext from "./ButtonNext";
import {SurveyDataContext} from "./SurveyDataContext";

const styles = theme => ({
  paper: {
    // height: 340,
    padding: 10,
    marginBottom: 12,
    elevate: 0
  },
  mainContainer: {
    marginTop: 30
  }

});

/***
 *
 * @param classes
 * @returns {JSX.Element}
 * @constructor
 */
function Survey({classes}) {

  const {questions,  updateQuestionsState, user} = useContext(SurveyDataContext);

  const params = useParams();
  const question = questions.find(q => (q.url === params.id));
  const qIndex = questions.findIndex(q => (q.url === params.id));

  // Questions and user is still not found
  if (questions.length === 0 || !user) return (<h3 className={'center'}>..loading</h3>);

  //Questions are loaded but there is no data about question because of wrong url
  if (!question) return <Navigate to="/404" replace={true}/>


  return (
    <Container maxWidth="sm" className={classes.mainContainer}>
      <DialogSessionCheck openedQuestion={question} />
      <Box id="Survey">
        <LinearProgress variant="determinate"
                        value={((1 + qIndex) / questions.length) * 100}
                        color="secondary"
        />
        <Paper className={classes.paper}>
          <Question question={question} onChangeCallback={updateQuestionsState}/>
        </Paper>
        <ButtonNext currentQuestion={question}/>
      </Box>
    </Container>
  );

}


export default withStyles(styles)(Survey);

import Button from "@material-ui/core/Button";
import {Link} from "react-router-dom";
import React, {useContext} from "react";
import {SurveyDataContext} from "./SurveyDataContext";


/**
 *
 * @param currentQuestion
 * @returns {JSX.Element}
 * @constructor
 */
function ButtonNext({currentQuestion}) {

  const {questions, saveAnswer} = useContext(SurveyDataContext);
  
  let label = 'See results';
  let target = "/results";
  const {display_order} = currentQuestion;

  const nextQuestion = questions.find(q => (parseInt(q.display_order) > parseInt(display_order)));

  if (nextQuestion) {
    label = 'Next';
    target = `/check/${nextQuestion.url}`;
  }

  return (
    <Button color="primary"
            variant="contained"
            component={Link}
            to={target}
            onClick={() => saveAnswer(currentQuestion)}
    >{label}</Button>
  );

}

export default ButtonNext;
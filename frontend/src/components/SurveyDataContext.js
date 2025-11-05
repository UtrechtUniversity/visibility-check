import React, {createContext, useEffect, useState} from "react";
import Api from "./Api";

const SurveyDataContext = createContext(undefined);


function SurveyData ({children}) {

  const [questions, setQuestions] = useState([]);
  const [user, setUser] = useState();
  const [error, setError] = useState(false);

  // Instantiate the api every time to be sure to have the bearer token
  const api = Api();

  /**
   * Load the data when the component is mounted
   */
  useEffect(() => {

    async function getData() {
      await Promise.all([
        api.getQuestions(),
        api.getUser()
      ])
        .then(([questions, user]) => {
          // Add values array
          // Todo check if can be removed
          questions.data.forEach(q => q.value = []);
          setQuestions(questions.data);

          if(user.data.session_id) {
            //TODO use user.headers.authorization
            localStorage.setItem('vcToken', user.data.session_id);
          }
          setUser(user.data);
        })
        .catch((error) => {
          // TODO Log?
          console.log(error);
          setError(true);
        });
    }

    getData();

  }, []);


  /**
   * Persist User's answer to the api
   *
   * @param question
   */
  function saveAnswer(question) {
    const payload = {
      userid: user.id,
      questionid: question.id,
      values: question.value
    };

    api.saveAnswer(payload)
      .then(res => {
        // TODO improve here
        // console.log ('SQ', res);
      })
      .catch( error => {
        // TODO improve here
        console.log('SAVE ANSWER ERROR', error);
        setError(true);
      });
  }

  /**
   * Update the questions array with the answers given by the user
   *
   * @param question
   */
  function updateQuestionsState(updatedQuestion) {
    const updatedQuestions = questions.map(item => (updatedQuestion.id === item.id) ? updatedQuestion : item);
    setQuestions(updatedQuestions);
  }

  if (error) throw error;

  return (
    <SurveyDataContext.Provider value={{
      questions, setQuestions, updateQuestionsState,
      user,
      saveAnswer
    }}>
      {children}
    </SurveyDataContext.Provider>
  )
}

export {SurveyData, SurveyDataContext};
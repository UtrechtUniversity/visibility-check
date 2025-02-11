import React from 'react';
import Radio from '@material-ui/core/Radio';
import RadioGroup from '@material-ui/core/RadioGroup';
import FormControlLabel from '@material-ui/core/FormControlLabel';

/**
 * Radio Button question
 *
 * @param question
 * @param changeCallback
 * @returns {JSX.Element}
 * @constructor
 */
function RadioButton({question, changeCallback}){

  /**
   * updates the question array with the  answers
   *
   * @param event
   */
  function handleChange(event) {
    const newQuestionState = {...question, value: [event.target.value]}
    changeCallback(newQuestionState);
  }

  return (
    <div>
      <RadioGroup aria-label="Choose one option" name=""
                  value={question.value[0] || ''} onChange={handleChange}>
        {question.options.map((item, index) => (
          <FormControlLabel key={index}
                            value={item.value}
                            control={<Radio/>}
                            label={item.label}/>
        ))}
      </RadioGroup>
    </div>
  )

}


export default RadioButton;

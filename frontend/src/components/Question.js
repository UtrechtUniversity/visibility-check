import React from 'react';
import FormControl from '@material-ui/core/FormControl';
import RadioButton from "./RadioButton";
import CheckboxQuestion from "./CheckboxQuestion";

/**
 *
 * @param question
 * @param onChangeCallback
 * @returns {JSX.Element}
 * @constructor
 */
function Question({question, onChangeCallback}) {

  return (
    <div id='question'>
      <InfoLink question={question}/>
      <FormControl component="fieldset">
        {question.type === 'checkbox' ?
          <CheckboxQuestion question={question}
                            onChangeCallback={onChangeCallback}/> :
          <RadioButton question={question}
                       changeCallback={onChangeCallback}/>
        }
      </FormControl>
    </div>
  )

}

/**
 * Print a link in the question text
 * @param props
 * @returns {*}
 */
function InfoLink({question}) {

  const {linkurl, linktext, text} = question;

  if (linkurl && linkurl.length && linktext && linktext.length) {
    const link = <a href={linkurl} target={'__blank'}>{linktext}</a>;
    const [part1, part2] = text.split(linktext);
    return (
      <p>{part1}{link}{part2}</p>
    );
  }
  return (<p>{text}</p>);
}


export default Question;
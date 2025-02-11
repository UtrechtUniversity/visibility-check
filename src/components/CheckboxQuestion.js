import React from "react";
import CheckboxItem from "./CheckboxItem";

const CheckboxQuestion = ({question, onChangeCallback}) => {


  /**
   * updates the question  with the  answers,
   * todo: not a real reactish way to handle the update
   *       may change in the future
   *
   * @param isChecked
   * @param index
   * @param value
   */
  function updateQuestion(isChecked, index, value) {

    // Update the options
    question.options[index].checked = isChecked;
    // value is not undefined only for the options with label "other"
    if (value !== undefined) {
      question.options[index].value = value;
    }

    // Update the question.value filed with each checked option value
    question.value = [];
    question.options.forEach(item => {
      if (item.checked) {
        question.value.push(item.value);
      }
    });

    onChangeCallback(question);

  }


  const options = question.options;
  if (!options) {
    return null;
  }


  return options.map((aCheckbox, index) => (
    <CheckboxItem
      key={index}
      checkboxLabel={aCheckbox.label}
      checkboxValue={aCheckbox.value}
      checked={question.value.includes(aCheckbox.value)}
      checkboxChangeCallback={
        (checkStatus, value) => updateQuestion(checkStatus, index, value)
      }
    />
  ));
}

export default CheckboxQuestion;
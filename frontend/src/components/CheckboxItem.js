import React from "react";
import FormControlLabel from "@material-ui/core/FormControlLabel";
import Checkbox from "@material-ui/core/Checkbox";
import TextField from "@material-ui/core/TextField";


/**
 * Special checkbox for the "Other" options
 * @param label
 * @param value
 * @param checkboxChangeCallback
 * @returns {JSX.Element}
 */

function CheckboxOther({label, value, checkboxChangeCallback}) {

  /**
   * Updates the value of an "Other value" checkbox with the value of the input fields
   *
   * @param event
   */
  const updateOtherValue = (event) => {
    checkboxChangeCallback((event.target.value.length > 0), event.target.value)
  };

  /**
   *
   * @param event
   */
  const clearOther = (event) => {
    event.target.value = event.target.value.replace('other', '');
  };

  return (
    <TextField id={'other'} variant="outlined"
               value={value}
               onChange={updateOtherValue}
               onClick={clearOther}
               size={"small"}
    />
  )
}

/**
 *
 * @param checkboxChangeCallback
 * @param checkboxValue
 * @param checkboxLabel
 * @param checked
 * @returns {JSX.Element}
 * @constructor
 */
const CheckboxItem = ({checkboxChangeCallback, checkboxValue, checkboxLabel, checked}) => {

  /**
   *
   * @param event
   */
  function handleCheckboxChange(event) {
    checkboxChangeCallback(event.target.checked);
  }

  return (
    <div>
      <FormControlLabel
        control={
          <Checkbox
            checked={checked}
            onChange={handleCheckboxChange}
            value={checkboxValue}
          />
        }
        label={checkboxLabel}
      />
      {checkboxLabel.toLowerCase() === 'other' &&
        <CheckboxOther label={checkboxLabel}
                       value={checkboxValue}
                       checkboxChangeCallback={checkboxChangeCallback}/>}
    </div>
  )
}


export default CheckboxItem;
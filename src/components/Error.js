import React from 'react'
import {Container} from "@material-ui/core";
import withStyles from "@material-ui/core/styles/withStyles";

const styles = theme => ({

  mainContainer: {
    marginTop: 30
  }

});

function Error({classes}) {

  return (
    <Container maxWidth="sm" className={classes.mainContainer}>
      <div>
        <h2>Ooops!</h2>
        <p>An error occurred, please try again later.</p>
      </div>
    </Container>)
};

export default withStyles(styles)(Error);
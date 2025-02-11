import React from 'react'
import {Container} from "@material-ui/core";
import withStyles from "@material-ui/core/styles/withStyles";
import {Link as RouterLink} from "react-router-dom";

const styles = theme => ({

  mainContainer: {
    marginTop: 30
  }

});

function NotFound({classes, param}) {


  return (
    <Container maxWidth="sm" className={classes.mainContainer}>
      <div>
        <h2>Not Found.</h2>
        <p>The page you requested is not found. Return to the <RouterLink to="/">home page</RouterLink></p>
      </div>
    </Container>
  )
}

export default withStyles(styles)(NotFound);
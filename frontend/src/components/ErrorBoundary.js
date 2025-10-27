import React from "react";
import {Alert, AlertTitle} from "@material-ui/lab";
import { Paper} from "@material-ui/core";
import {withStyles} from "@material-ui/core/styles";

const styles = (theme) => ({
  paper: {
    padding: theme.spacing(2),
    margin: '2em auto',
    maxWidth: 500,
  }
});


class ErrorBoundary extends React.Component {


  constructor(props) {
    super(props);
    this.state = {hasError: false};
  }

  static getDerivedStateFromError(error) {
    // Update state so the next render will show the fallback UI.
    return {hasError: true};
  }

  render() {
    const {classes} = this.props;
    if (this.state.hasError) {
      // You can render any custom fallback UI
      return (
        <Paper className={classes.paper}>
          <Alert severity={"error"}>
            <AlertTitle>Error</AlertTitle>
            Something went wrong.
          </Alert>
        </Paper>
      );
    }
    return this.props.children;
  }
}

export default withStyles(styles)(ErrorBoundary)


import {useTheme} from "@mui/material/styles";
import useMediaQuery from "@mui/material/useMediaQuery";
import {ReactComponent as LogoImg} from "../Utrecht_University_logo.svg";
import React from "react";
import makeStyles from "@mui/styles/makeStyles";
import withStyles from "@mui/styles/withStyles";
import {adaptV4Theme, createTheme} from "@mui/material";
import createStyles from "@mui/styles/createStyles";


const theme = createTheme(adaptV4Theme({
  palette: {
    primary: {
      main: '#FFCD00',
    },
    secondary: {
      main: '#C00A35',
    },
  },
  props: {
    MuiPaper: {
      square: true,
      elevation: 0
    }
  },
  overrides: {
    MuiPaper: createStyles({})
  }

}));


const styles = theme => ({
  root: {
    flexGrow: 1,
    backgroundColor: '#ffffff'
  },
  main: {
    paddingBottom: theme.spacing(15),
  },
  menuButton: {
    marginRight: theme.spacing(2),
  },
  title: {
    flexGrow: 1,
    '& a' : {
      textDecoration: 'none',
      color: 'inherit'
    }
  },
  subtitle: {
    fontStyle: 'italic',
    fontSize: 14,
  }

});

const useStyles = makeStyles({
  logo: {
    height: 80,
    [theme.breakpoints.down('sm')]: {
      height: 55,
    },
  },
});

/**
 *
 * @returns {JSX.Element}
 * @constructor
 */
function UULogo() {
  const classes = useStyles();
  const theme = useTheme();
  const small = useMediaQuery(theme.breakpoints.down('sm'));

  return (
    <span>
    {small ?
      <img src="/Utrecht_University_logo_xs.png" className={classes.logo} alt="Logo Utrecht University"/> :
      <LogoImg className={classes.logo} alt="Logo Utrecht University"/>
    }
    </span>
  );
}

export default withStyles(styles)(UULogo);
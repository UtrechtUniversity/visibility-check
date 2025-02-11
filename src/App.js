import React from 'react';
import {BrowserRouter, Route, Routes} from 'react-router-dom';
import './App.css'
import Survey from './components/Survey';
import Intro from './components/Intro';
import Results from "./components/Results";
import NotFound from "./components/NotFound";
import Footer from "./components/Footer";
import Error from "./components/Error";

// @material-ui
import {AppBar, Toolbar, CssBaseline, createTheme, createStyles} from '@material-ui/core'
import Typography from "@material-ui/core/Typography";
import {withStyles, ThemeProvider} from "@material-ui/core/styles";
import Grid from "@material-ui/core/Grid";
import useTheme from "@material-ui/core/styles/useTheme";
import useMediaQuery from "@material-ui/core/useMediaQuery";
import makeStyles from "@material-ui/core/styles/makeStyles";

// Images
import {ReactComponent as LogoImg} from "./Utrecht_University_logo.svg";
import {SurveyData} from "./components/SurveyDataContext";
import ErrorBoundary from "./components/ErrorBoundary";



const theme = createTheme({
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

});

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
    [theme.breakpoints.down('xs')]: {
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
  const small = useMediaQuery(theme.breakpoints.down('xs'));

  return (
    <span>
    {small ?
      <img src="/Utrecht_University_logo_xs.png" className={classes.logo} alt="Logo Utrecht University"/> :
      <LogoImg className={classes.logo} alt="Logo Utrecht University"/>
    }
    </span>
  );
}

/**
 *
 * @param classes
 * @returns {JSX.Element}
 * @constructor
 */
function App({classes}) {


  return (
    <div className={classes.root}>
      <ThemeProvider theme={theme}>
        <CssBaseline/>
        <AppBar position="static">
          <Toolbar>
            <Grid container
                  justifyContent="space-between"
                  alignItems="center">
              <Grid item xs={3}>
                <Typography>
                  <a href="https://www.uu.nl/en/university-library" target="_blank" rel="noopener noreferrer">
                    <UULogo/>
                  </a>
                </Typography>
              </Grid>
              <Grid item xs={6}>
                <Typography variant="h5" align={"center"} className={classes.title}>
                  <a href={"/"} >
                    Visibility Check
                  </a>
                </Typography>
                <Typography align={"center"} className={classes.subtitle}>
                  Utrecht University Library
                </Typography>
              </Grid>
              <Grid item xs={3}>
              </Grid>
            </Grid>
          </Toolbar>
        </AppBar>
        <main className={classes.main}>
          <ErrorBoundary>
            <SurveyData>
              <BrowserRouter>
                <Routes>
                  <Route path="/" element={<Intro/>}/>
                  <Route path="/check" element={<NotFound/>}/>
                  <Route path="/check/:id" element={<Survey/>}/>
                  <Route path="/results" element={<Results/>}/>
                  <Route path="/error" element={<Error/>}/>
                  <Route path="/404" element={<NotFound/>}/>
                </Routes>
              </BrowserRouter>
            </SurveyData>
          </ErrorBoundary>
        </main>
        <Footer/>
      </ThemeProvider>
    </div>
  );

}

export default withStyles(styles, {withTheme: true})(App);

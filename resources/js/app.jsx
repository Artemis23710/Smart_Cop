import React from 'react';
import ReactDOM from 'react-dom';
import { CssBaseline, Container, Typography } from '@mui/material';

const App = () => {
    return (
        <Container>
            <CssBaseline />
            <Typography variant="h1" component="h2">
                Hello, Material-UI!
            </Typography>
        </Container>
    );
};

ReactDOM.render(<App />, document.getElementById('app'));

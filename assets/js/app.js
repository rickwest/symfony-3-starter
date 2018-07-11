// Bootstrap Javascript
import 'bootstrap';

// Styles
import '../sass/app.scss';

import ExampleComponent from './components/ExampleComponent';

import React from 'react';
import ReactDOM from 'react-dom';

ReactDOM.render(<ExampleComponent/>, document.getElementById('app'));
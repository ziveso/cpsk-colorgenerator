import React from 'react'
import ReactDOM from 'react-dom'
import App from './components/App'

import Store from './StudentStore'

ReactDOM.render(<App store={Store}/>, document.getElementById('app'))
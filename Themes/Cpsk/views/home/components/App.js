import React from 'react'
import { InputWrapper } from './InputWrapper'// eslint-disable-line no-unused-vars
import './App.css'
import { Rainbow } from './Rainbow'// eslint-disable-line no-unused-vars
import { observer } from 'mobx-react'
import { Welcome } from './Welcome'
import { History } from './History'

@observer
export class App extends React.Component {
    render() {
        return (
            <div>
                {/* <Rainbow /> */}
                {/* <div className='text-center header'> */}
                {/* <h1>{ siteName }</h1> eslint-disable-line variable from blade php  */}
                {/* </div> */}
                <Welcome store={this.props.store}/>
                <InputWrapper store={this.props.store}/>
                <History store={this.props.store}/>
            </div>
        )
    }
}

export default App

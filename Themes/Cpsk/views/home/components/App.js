import React from 'react'
import { InputWrapper } from './InputWrapper'// eslint-disable-line no-unused-vars
import './App.css'
import { Rainbow } from './Rainbow'// eslint-disable-line no-unused-vars
import { observer } from 'mobx-react'

@observer
export class App extends React.Component {
    render() {
        return (
            <div>
                <div className='text-center header'>
                    <h1>{ siteName }</h1> {/* eslint-disable-line */} {/* variable from blade php  */}
                </div>
                <h1 className='text-center'>{ this.props.store.isGenerated ? 'Complete' : 'Generating' }</h1>
                {/* <h1>ยินดีด้วย น้อง { this.props.store.lastGenerated.name } ได้อยู่มุ้ง { this.props.store.lastGenerated.color }</h1> */}
                <Rainbow />
                <InputWrapper store={this.props.store}/>
            </div>
        )
    }
}

export default App

import React from 'react'
import './InputWrapper.css'
import { observer } from 'mobx-react'

@observer
export class InputWrapper extends React.Component {
    handleChange(e) {
        this.props.store.studentId = e.target.value
        if(e.which===13) {
            this.handleSubmit()
        }
    }

    handleSubmit() {
        // generate
        this.props.store.generateColor()
        this.props.store.studentId = 0
    }
    
    render() {
        return (
            <div>
                <div id='inputWrapper' className='center-on-screen'>
                    <div>
                        <input type='value' placeholder='STUDENT ID' onKeyPress={this.handleChange.bind(this)}/>
                    </div>
                    <div>
                        <button onClick={this.handleSubmit.bind(this)}>SUBMIT</button>
                    </div>
                </div>
            </div>
        )
    }
}

export default InputWrapper

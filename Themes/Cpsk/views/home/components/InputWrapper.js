import React from 'react'
import './InputWrapper.css'
import { observer } from 'mobx-react'

@observer
export class InputWrapper extends React.Component {
    handleChange(e) {
        this.props.store.studentId = e.target.value
    }

    handleSubmit() {
        this.props.store.generateColor()
        this.props.store.studentId = ''
    }

    handleKeyPress(e) {
        if (e.key === 'Enter') {
            this.handleSubmit();
        }
    }
    
    render() {
        return (
            <div>
                <div id='inputWrapper' className='center-on-screen'>
                    <div>
                        <input type='value' placeholder='STUDENT ID' onKeyPress={this.handleKeyPress.bind(this)} onChange={this.handleChange.bind(this)} value={this.props.store.studentId}/>
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

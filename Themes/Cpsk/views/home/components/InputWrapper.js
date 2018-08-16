import React from 'react'
import './InputWrapper.css'
import { observer } from 'mobx-react'

@observer
export class InputWrapper extends React.Component {
    constructor(props) {
        super(props)
        this.state = {
            isValidate: false
        }
    }
    handleChange(e) {
        if(e.target.value.length != 10) {
            this.setState({isValidate: false})
        } else {
            const gender = this.props.store.female.includes(e.target.value) ? 'female' : 'male'
            this.setState({isValidate: true, gender: gender})
        }
        this.props.store.studentId = e.target.value
    }

    handleSubmit() {
        if(this.state.isValidate) {
            this.props.store.generateColor()
            this.props.store.studentId = ''
            this.setState({isValidate: false})
        }
    }

    handleKeyPress(e) {
        if (e.key === 'Enter') {
            this.handleSubmit()
        }
    }
    
    render() {
        return (
            <div>
                <div id='inputWrapper' className='center-on-screen'>
                    <div>
                        <input className={`${ this.state.isValidate ? 'validated' : 'inValidate'} ${ this.state.gender }`} type='value' placeholder='STUDENT ID' onKeyPress={this.handleKeyPress.bind(this)} onChange={this.handleChange.bind(this)} value={this.props.store.studentId}/>
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

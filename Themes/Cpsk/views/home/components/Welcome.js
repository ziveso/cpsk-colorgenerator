import React from 'react'
import './Welcome.css'
import { observer } from 'mobx-react'

@observer
export class Welcome extends React.Component {
    render() {
        const { lastGenerated, isGenerated, firstCome } = this.props.store
        console.log(firstCome);
        if(firstCome)
            return <div></div>
        return (
            <div className='text-center'>
                <div className={`welcome-box ${ !isGenerated ? 'active' : 'in-active' }`}>
                    <div className='welcome-text'><b>{lastGenerated.name} ได้อยู่มุ้ง {lastGenerated.color}</b></div>
                </div>
            </div>
        )
    }
}

export default Welcome

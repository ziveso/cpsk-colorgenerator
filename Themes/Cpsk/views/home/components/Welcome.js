import React from 'react'
import './Welcome.css'
import { observer } from 'mobx-react'

@observer
export class Welcome extends React.Component {
    render() {
        const { lastGenerated, isGenerated } = this.props.store
        return (
            <div className='text-center'>
                <div className={`welcome-box ${ isGenerated ? 'active' : 'in-active' }`}>
                    <div className='welcome-text'>น้อง {lastGenerated.name} ได้อยู่มุ้ง {lastGenerated.color}</div>
                </div>
            </div>
        )
    }
}

export default Welcome

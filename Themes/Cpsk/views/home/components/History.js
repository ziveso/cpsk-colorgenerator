import React from 'react'
import { observer } from 'mobx-react'
import './History.css'

@observer
export class History extends React.Component {
    render() {
        const { history } = this.props.store
        var hiscomp = history.map((item,id) => {
            return <div key={`card-${id}`} className={`card ${item.color} text-center`}>{item.name}</div>
        }) 

        hiscomp = hiscomp.reverse()
        return (
            <div className='history'>
                {hiscomp}
            </div>
        )
    }
}

export default History

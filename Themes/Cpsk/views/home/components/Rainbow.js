import React from 'react'
import './Rainbow.css'

export class Rainbow extends React.Component {
    render() {
        return (
            <div id='rainbow'>
                <div id='rainbow-1' className='rainbow'/>
                <div id='rainbow-2' className='rainbow'/>
                <div id='rainbow-3' className='rainbow'/>
                <div id='rainbow-4' className='rainbow'/>
                <div id='rainbow-5' className='rainbow'/>
                <div id='rainbow-6' className='rainbow'/>
                {/* <div id='rainbow-7' className='rainbow'/> */}
            </div>
        )
    }
}

export default Rainbow

import { observable } from 'mobx'
import Axios from 'axios'

class LastGenerated {
    constructor(name,color) {
        this.name = name
        this.color = color
    }
}
class StudentStore {
    @observable studentId = ''
    @observable isGenerated = true
    @observable lastGenerated = new LastGenerated('','')
    
    async generateColor() {
        // check if studentid match ?

        this.isGenerated = false
        // fetch color from server
        // done
        await Axios.post(createApi, {
            data: {
                studentId: this.studentId
            }
        }).then( (res) => {
            this.lastGenerated = new LastGenerated(res.data.name,res.data.color)
        } ).catch( (err) => console.log(err))
        this.isGenerated = true
    }
}

var store = new StudentStore

export default store

import { observable } from 'mobx'
import Axios from 'axios'

class LastGenerated {
    constructor(name,color,gender) {
        this.name = name
        this.color = color
        this.gender = gender
    }
}
class StudentStore {
    @observable studentId = ''
    @observable firstCome = true
    @observable isGenerated = true
    @observable lastGenerated = new LastGenerated('','')
    @observable history = []
    @observable female = []

    constructor() {
        Axios.get(studentApi).then((res) => this.female = res.data.female).catch()
    }
    
    async generateColor() {
        this.firstCome = false
        this.isGenerated = false
        await Axios.post(createApi, {
            data: {
                studentId: this.studentId
            }
        }).then( (res) => {
            this.lastGenerated = new LastGenerated(res.data.name,res.data.color,res.data.gender)
            this.history.push(this.lastGenerated)
        } ).catch( (err) => console.log(err))

        this.isGenerated = true
    }
}

var store = new StudentStore

export default store

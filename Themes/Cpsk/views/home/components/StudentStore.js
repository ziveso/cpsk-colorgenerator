import { observable, computed } from 'mobx'

class StudentStore {
    @observable studentId = 0
    @observable isGenerated = true
    generateColor() {
        alert(this.studentId)
        this.isGenerated = false
        // fetch color from server
        this.isGenerated = true
        // done
    }
}

var store = new StudentStore

export default store

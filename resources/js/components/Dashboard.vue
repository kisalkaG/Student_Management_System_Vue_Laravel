<template>
  <div>
    <div class="container">

   <button type="button" @click.prevent="create()" class="btn btn-primary" data-toggle="modal" data-target="#myModal">{{"Create"}}</button>


      <table class="table table-dark">
        <thead>
          <tr>
            <th>{{("id")}}</th>
            <th>{{("Name")}}</th>
            <th>{{("Addres")}}</th>
            <th>{{("Email")}}</th>
            <th>{{("Edit")}}</th>
            <th>{{("Delete")}}</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="student in students" :key="student.id">
            <td>{{student.id}}</td>
            <td>{{student.name}}</td>
            <td>{{student.address}}</td>
            <td>{{student.email}}</td>
            <td>
                <button type="button" @click.prevent="editRecord(student)" class="btn btn-primary" data-toggle="modal" data-target="#myModal">{{"Edit"}}</button>
                
            </td>
            <td>
                <button type="button" class="btn btn-danger" @click.prevent="deleteRecord(student.id)">{{"Delete"}}</button>
            </td>
          </tr>          
        </tbody>
      </table>
    </div>
     
     <div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Modal Heading</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form>
    <div class="form-group">
      <label for="name">{{("Name")}}</label>
      <input type="text" class="form-control" id="name" placeholder="Enter Name" name="Name" v-model="studentName">
    </div>
    <div class="form-group">
      <label for="address">{{("Address")}}</label>
      <input type="text" class="form-control" id="address" placeholder="Enter Address" name="Address" v-model="studentAddress">
    </div>
    <div class="form-group">
      <label for="email">{{("Email")}}</label>
      <input type="text" class="form-control" id="email" placeholder="Enter Email" name="Email" v-model="studentEmail">
    </div>
   
   
  </form>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="submit" v-if ="isNew === true" class="btn btn-primary"  data-dismiss="modal" @click.prevent="saveRecord()">{{("Submit")}}</button>
        <button type="submit" v-else  class="btn btn-primary"  data-dismiss="modal" @click.prevent="updateRecord()">{{("Update")}}</button>

        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
    
  </div>
</template>

<script>
export default {
  data() {
    return {
      students: [],
      studentName:"",
      studentAddress:"",
      studentEmail:"",
      studentId:null,
      isNew: true

    };
  },

  mounted() {
    this.getAllStudents();
  },

  methods: {
    getAllStudents() {
      axios.get("get-all-students").then((res) => {
        if (res.data.length > 0) {
          this.students = res.data;
        } else {
          this.students = [];
        }
      });
    },  

    create() {
        this.isNew = true;
    },

    saveRecord() {
      let student = {
           name: this.studentName,
           address: this.studentAddress,
           email: this.studentEmail,
           
       }    
           axios.post("create-student",student).then(res => {
              console.log(res);
              window.location.reload();
              
       })
    },

    editRecord(student) {
        this.studentName = student.name;
        this.studentAddress = student.address;
        this.studentEmail = student.email;
        this.studentId = student.id;  
        this.isNew = false;
               
    },

    updateRecord() {
        let student = {
            name:  this.studentName,
            address: this.studentAddress,
            email: this.studentEmail,            
        }      
       
        axios.post('update-student/'+this.studentId,student).then(res => {
            console.log(res);
            window.location.reload();
        })
    },

    deleteRecord(id) {
          axios.post('delete-student/'+id).then(res=> {
            window.location.reload();
          })
    }
  },
};
</script>

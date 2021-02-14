<template>
    <div class="container box">
        <h1>{{ "Student Information" }}</h1>

        <div>
            <router-link
                to="/register-form"
                type="button"
                class="btn btn-outline-primary btn-lg text-center"
                >{{ "Create New Student" }}
            </router-link>
        </div>

        <table class="table table-dark">
            <thead>
                <tr>
                    <th>{{ "id" }}</th>
                    <th>{{ "Name" }}</th>
                    <th>{{ "Addres" }}</th>
                    <th>{{ "Email" }}</th>
                    <th>{{ "Edit" }}</th>
                    <th>{{ "Delete" }}</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="student in students" :key="student.id">
                    <td>{{ student.id }}</td>
                    <td>{{ student.name }}</td>
                    <td>{{ student.address }}</td>
                    <td>{{ student.email }}</td>
                    <td>
                        <button
                            type="button"
                            @click.prevent="openModal(student)"
                            class="btn btn-primary"
                        >
                            {{ "Edit" }}
                        </button>
                    </td>
                    <td>
                        <button
                            type="button"
                            class="btn btn-danger"
                            @click.prevent="deleteRecord(student.id)"
                        >
                            {{ "Delete" }}
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="text-right">
            <router-link
                to="/dashboard"
                type="button"
                class="btn btn-dark text-right"
                >{{ "Back" }}
            </router-link>
        </div>

        <div class="modal" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Modal Heading</h4>
                        <button
                            type="button"
                            class="close"
                            @click.prevent="closeModal()"
                        >
                            &times;
                        </button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="name">{{ "Name" }}</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="name"
                                    placeholder="Enter Name"
                                    name="Name"
                                    v-model="studentName"
                                />
                            </div>
                            <div class="form-group">
                                <label for="address">{{ "Address" }}</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="address"
                                    placeholder="Enter Address"
                                    name="Address"
                                    v-model="studentAddress"
                                />
                            </div>
                            <div class="form-group">
                                <label for="email">{{ "Email" }}</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="email"
                                    placeholder="Enter Email"
                                    name="Email"
                                    v-model="studentEmail"
                                />
                            </div>
                        </form>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button
                            type="submit"
                            v-if="isNew === true"
                            class="btn btn-primary"
                            data-dismiss="modal"
                            @click.prevent="saveRecord()"
                        >
                            {{ "Submit" }}
                        </button>
                        <button
                            type="submit"
                            v-else                            
                            class="btn btn-primary"
                            @click.prevent="updateRecord()"
                        >
                            {{ "Update" }}
                        </button>

                        <button
                            type="button"
                            class="btn btn-danger"
                            @click.prevent="closeModal()"
                        >
                            Close
                        </button>
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
            studentName: "",
            studentAddress: "",
            studentEmail: "",
            studentId: null,
            isNew: true
        };
    },

    mounted() {
        this.getAllStudents();
    },

    methods: {
        getAllStudents() {
            axios.get("get-all-students").then(res => {
                if (res.data.length > 0) {
                    this.students = res.data;
                } else {
                    this.students = [];
                }
            });
        },

        openModal(student) {
            this.studentName = student.name;
            this.studentAddress = student.address;
            this.studentEmail = student.email;
            this.studentId = student.id;
            this.isNew = false;

            $("#myModal").modal("show");
        },

        closeModal() {
            $("#myModal").modal("hide");
        },

        updateRecord() {
            let student = {
                name: this.studentName,
                address: this.studentAddress,
                email: this.studentEmail
            };

            axios
                .post("update-student/" + this.studentId, student)
                .then(res => {
                    if (res.data) {
                        this.$swal({
                            title: "Succeed",
                            text: "Student updated successfully",
                            icon: "success",
                            showCancelButton: false,
                            confirmButtonColor: "#3085d6",
                            confirmButtonText: "Ok"
                        }).then(result => {
                            if (result.isConfirmed) {
                                this.closeModal();
                                this.getAllStudents();
                            }
                        });
                    }
                });
        },

        deleteRecord(id) {
            this.$swal
                .fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                })
                .then(result => {
                    if (result.isConfirmed) {
                        axios.post("delete-student/" + id).then(res => {
                            this.$swal
                                .fire(
                                    "Deleted!",
                                    "Your file has been deleted.",
                                    "success"
                                )
                                .then(result => {
                                    if (result.isConfirmed) {
                                        this.getAllStudents();
                                    }
                                });
                        });
                    }
                });
        }
    }
};
</script>

<style scoped>
.box {
    background-color: lightgray;
}
</style>

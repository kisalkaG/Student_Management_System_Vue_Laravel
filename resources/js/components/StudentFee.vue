<template>
    <div class="container">
        <button
            type="button"
            class="btn btn-primary"
            @click.prevent="openModal(null, true)"
        >
            {{ "Add" }}
        </button>
        <table class="table table-dark">
            <thead>
                <tr>
                    <th>{{ "Month" }}</th>
                    <th>{{ "Fee" }}</th>
                    <th>{{ "Edit" }}</th>
                    <th>{{ "Delete" }}</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="studentFee in studentsFees" :key="studentFee.id">
                    <td>{{ studentFee.month }}</td>
                    <td>{{ studentFee.fees }}</td>

                    <td>
                        <button
                            type="button"
                            class="btn btn-primary"
                            @click.prevent="openModal(studentFee, false)"
                        >
                            {{ "Edit" }}
                        </button>
                    </td>
                    <td>
                        <button
                            type="button"
                            class="btn btn-danger"
                            @click.prevent="deleteRecord(studentFee.id)"
                        >
                            {{ "Delete" }}
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>

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
                                <label for="fee">{{ "fee" }}</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="fee"
                                    placeholder="Enter Fee"
                                    name="fee"
                                    v-model="studentFee"
                                />
                            </div>
                            <div class="form-group">
                                <label for="month">{{ "Month" }}</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="month"
                                    placeholder="Enter Month"
                                    name="month"
                                    v-model="month"
                                />
                            </div>

                            <div class="form-group">
                                <label for="id">{{ "Student" }}</label>
                                <select
                                    class="form-control"
                                    name="Students"
                                    id="students"
                                    v-model="studentId"
                                >
                                    <option value="">{{
                                        "Select a student"
                                    }}</option>
                                    <option
                                        :value="student.id"
                                        v-for="student in studentData"
                                        :key="student.id"
                                        >{{ student.name }}</option
                                    >
                                </select>
                            </div>
                        </form>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button
                            type="submit"
                            class="btn btn-primary"
                            @click.prevent="saveRecord()"
                        >
                            {{ "Submit" }}
                        </button>

                        <button
                            type="button"
                            class="btn btn-danger"
                            @click.prevent="closeModal()"
                        >
                            {{ "Close" }}
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
            studentFee: "",
            month: "",
            studentId: null,
            studentData: [],
            studentsFees: [],
            isNew: true,
            editRecordId: null
        };
    },

    mounted() {
        this.getStudentsDataForDropDown();
        this.getAllStudentFees();
    },

    methods: {
        openModal(studentFee, isNewRecord) {
            (this.isNew = true),
                (this.studentId = null),
                (this.month = ""),
                (this.studentFee = "");
            this.editRecordId = null;
            if (studentFee != null && isNewRecord == false) {
                this.editRecordId = studentFee.id;
                (this.studentId = studentFee.student_id),
                    (this.month = studentFee.month),
                    (this.studentFee = studentFee.fees),
                    (this.isNew = false);
            }
            $("#myModal").modal("show");
        },

        closeModal() {
            $("#myModal").modal("hide");
        },

        saveRecord() {
            let url = "";

            if (this.isNew == true) {
                url = "/save-student-fee";
            } else {
                url = "/update-student-fee/" + this.editRecordId;
            }

            let student = {
                student_id: this.studentId,
                month: this.month,
                fee: this.studentFee
            };

            axios.post(url, student).then(response => {
                if (response.data) {
                    this.$swal({
                        title: "Succeed",
                        text: "Student Fee updated successfully",
                        icon: "success",
                        showCancelButton: false,
                        confirmButtonColor: "#3085d6",
                        confirmButtonText: "Ok"
                    }).then(result => {
                        if (result.isConfirmed) {
                            this.closeModal();
                            this.getAllStudentFees();
                        }
                    });
                }
            });
        },

        getStudentsDataForDropDown() {
            axios.get("/student-data").then(response => {
                this.studentData = response.data;
            });
        },

        getAllStudentFees() {
            axios.get("/get-all-student-fees").then(response => {
                this.studentsFees = response.data;
            });
        },

        deleteRecord(id) {
            this.$swal({
                title: "Are sure you?",
                text: "This won't be revert!!!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                confirmButtonText: "Ok"
            }).then(result => {
                if (result.isConfirmed) {
                    axios.post("/delete-record/" + id).then(response => {
                        if (response.data) {
                            this.$swal({
                                title: "Success",
                                text: "Record deleted successfully !!!",
                                icon: "success",
                                showCancelButton: false,
                                confirmButtonColor: "#3085d6",
                                confirmButtonText: "Ok"
                            }).then(result => {
                                if (result.isConfirmed) {
                                    this.getAllStudentFees();
                                }
                            });
                        }
                    });
                }
            });
        }
    }
};
</script>

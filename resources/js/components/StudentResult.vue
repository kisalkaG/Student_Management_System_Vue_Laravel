<template>
    <div class="container">
        <h1>{{ "Student Results" }}</h1>
        <button
            type="button"
            class="btn btn-outline-primary"
            @click.prevent="openModal(null, true)"
        >
            {{ "Add Result" }}
        </button>
        <table class="table table-dark">
            <thead>
                <tr>
                    <th>{{ "Engineering Technology" }}</th>
                    <th>{{ "Science For Technology" }}</th>
                    <th>{{ "ICT" }}</th>
                    <th>{{ "Final Result" }}</th>
                    <th>{{ "Edit" }}</th>
                    <th>{{ "Delete" }}</th>
                </tr>
            </thead>
            <tbody>
                <tr
                    v-for="StudentRecord in StudentRecords"
                    :key="StudentRecord.id"
                >
                    <td>
                        {{ setResult(StudentRecord.engineering_technology) }}
                    </td>
                    <td>
                        {{ setResult(StudentRecord.scienceFor_technology) }}
                    </td>
                    <td>{{ setResult(StudentRecord.ict) }}</td>
                    <td>
                        {{ StudentRecord.final_result == 1 ? "pass" : "Fail" }}
                    </td>
                    <td>
                        <button
                            type="button"
                            class="btn btn-primary"
                            @click.prevent="openModal(StudentRecord, false)"
                        >
                            {{ "Edit" }}
                        </button>
                    </td>

                    <td>
                        <button
                            type="button"
                            class="btn btn-danger"
                            @click.prevent="deleteRecord(StudentRecord.id)"
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
                        <h4 class="modal-title">Add New Result</h4>
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
                                <label for="Student">{{
                                    "Student"
                                }}</label>
                                <select
                                    class="form-control"
                                    name="Student"
                                    id="Student"
                                    v-model="StudentId"
                                >
                                    <option hidden value ="" selected>{{
                                        "Select Student"
                                    }}</option>
                                    <option
                                        v-for="Student in studentData"
                                        :key="Student.id"
                                        :value="Student.id"
                                        >{{Student.name}}</option
                                    >
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="engineeringTechnology">{{
                                    "Engineering Technology"
                                }}</label>
                                <select
                                    class="form-control"
                                    name="Result"
                                    id="result"
                                    v-model="result1Id"
                                >
                                    <option hidden value="">{{
                                        "Select Result"
                                    }}</option>
                                    <option
                                        v-for="result in results"
                                        :key="result.id"
                                        :value="result.id"
                                        >{{ result.result }}</option
                                    >
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="scienceForTechnology">{{
                                    "Science For Technology"
                                }}</label>
                                <select
                                    class="form-control"
                                    name="Result"
                                    id="result"
                                    v-model="result2Id"
                                >
                                    <option hidden value="">{{
                                        "Select Result"
                                    }}</option>
                                    <option
                                        v-for="result in results"
                                        :key="result.id"
                                        :value="result.id"
                                        >{{ result.result }}</option
                                    >
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="ict">{{ "ICT" }}</label>
                                <select
                                    class="form-control"
                                    name="Result"
                                    id="result"
                                    v-model="result3Id"
                                >
                                    <option hidden value="">{{
                                        "Select Result"
                                    }}</option>
                                    <option
                                        v-for="result in results"
                                        :key="result.id"
                                        :value="result.id"
                                        >{{ result.result }}</option
                                    >
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="finalResult">{{
                                    "Final Result"
                                }}</label>
                                <select
                                    class="form-control"
                                    name="finalResult"
                                    id="finalResult"
                                    v-model="finalResultId"
                                >
                                    <option hidden value="">{{
                                        "Select Result"
                                    }}</option>
                                    <option
                                        v-for="finalResult in finalResults"
                                        :key="finalResult.id"
                                        :value="finalResult.id"
                                        >{{ finalResult.result }}</option
                                    >
                                </select>
                            </div>

                             
                        </form>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button
                            type="submit"
                            v-if="isNewRecord == true"
                            class="btn btn-primary"
                            @click.prevent="saveRecord()"
                        >
                            {{ "Submit" }}
                        </button>
                        <button
                            type="submit"
                            v-else
                            class="btn btn-primary"
                            @click.prevent="saveRecord()"
                        >
                            {{ "Update" }}
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
            subjects: [
                { id: 1, name: "Engineering Technology" },
                { id: 2, name: "Science For Technology" },
                { id: 3, name: "ICT" }
            ],
            result1Id: "",
            result2Id: "",
            result3Id: "",
            results: [
                { id: 1, result: "A" },
                { id: 2, result: "B" },
                { id: 3, result: "C" },
                { id: 4, result: "D" },
                { id: 5, result: "E" }
            ],
            finalResultId: "",
            finalResults: [
                { id: 1, result: "Pass" },
                { id: 2, result: "Fail" }
            ],
            StudentRecords: [],
            isNewRecord: true,
            updateRecordId: null,
            StudentId: null,
            studentData: []
        };
    },

    mounted() {
        this.getAllRecords();
        this.getStudentsDataForDropDown();
    },

    methods: {
        openModal(studentResult, newRecord) {
            if (studentResult != null && newRecord == false) {
                this.updateRecordId = studentResult.id;
                this.result1Id = studentResult.engineering_technology;
                this.result2Id = studentResult.scienceFor_technology;
                this.result3Id = studentResult.ict;
                this.finalResultId = studentResult.final_result;
                this.isNewRecord = false;
            }
            if (newRecord == true) {
                this.isNewRecord = true;
            }

            $("#myModal").modal("show");
        },

        closeModal() {
            $("#myModal").modal("hide");
        },

        saveRecord() {
            let url = "";
            let text="";

            if (this.isNewRecord == true) {
                url = "/save-student-result";
                text="Student result created successfully";

            } else {
                url = "/update-result/" + this.updateRecordId;
                text="Student result updated successfully";
            }

            let student = {
                engineering_technology: this.result1Id,
                scienceFor_technology: this.result2Id,
                ict: this.result3Id,
                final_result: this.finalResultId,
                student_id: this.StudentId
            };

            axios.post(url, student).then(response => {
                if (response.data) {
                    this.$swal({
                        title: "Succeed",
                        text: text,
                        icon: "success",
                        showCancelButton: false,
                        confirmButtonColor: "#3085d6",
                        confirmButtonText: "Ok"
                    }).then(result => {
                        if (result.isConfirmed) {
                            this.closeModal();
                            this.getAllRecords();
                        }
                    });
                }
                
            });

        },

        getAllRecords() {
            axios.get("/get-all-results").then(res => {
                console.log(res.data);
                this.StudentRecords = res.data;
            });
        },

        setResult(grade) {
            if (grade == 1) {
                return "A";
            } else if (grade == 2) {
                return "B";
            } else if (grade == 3) {
                return "C";
            } else if (grade == 4) {
                return "D";
            } else {
                return "E";
            }
        },

        deleteRecord(id) {
             this.$swal({
                title: "Are sure you?",
                text: "This won't be revert",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                confirmButtonText: "Ok"
            }).then(result => {
                if (result.isConfirmed) {
                    axios.post("/delete-result/" + id).then(res => {
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
                                    this.getAllRecords();
                                }
                            });
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
    }
};
</script>

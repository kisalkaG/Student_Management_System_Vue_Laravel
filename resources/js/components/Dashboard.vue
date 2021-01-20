<template>
  <div>
    <div class="container-fluid interface">
      <div class="text-center heading">{{ "Student Management System" }}</div>

      <div class="row">
        <div class="col-sm-5 dashboard_icon space">
          <img class="image mx-auto d-block" src="images/register.png" />
          {{ "Online Registration" }}
          <div>
            <router-link
              to="/register-form"
              type="button"
              class="btn btn-outline-dark btn-lg text-center"
              >{{ "Register" }}
            </router-link>
          </div>
        </div>

        <div class="col-sm-5 dashboard_icon space1">
          <img class="image mx-auto d-block" src="images/students.png" />
          {{ "Student Information" }}
          <div>
            <router-link
              to="/student-information"
              type="button"
              class="btn btn-outline-dark btn-lg text-center"
              >{{ "Information" }}
            </router-link>
          </div>
        </div>

        <div class="col-sm-5 dashboard_icon space">
          <img class="image mx-auto d-block" src="images/results.png" />
          {{ "Student Results" }}
          <div>
            <router-link
              to="/student-information"
              type="button"
              class="btn btn-outline-dark btn-lg text-center"
              >{{ "Results" }}
            </router-link>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
.main {
  display: flex;
  flex-direction: column;
}
.dashboard_icon {
  height: auto;
  width: auto;
  margin-top: 20px;
  padding: 20px;
  /* border: 1px solid black; */
  text-align: center;
  font-size: 30px;
  background-color: lightgray;
  border-radius: 5px;
}

.image {
  height: 200px;
}

.interface {
  background-color: black;
}

.heading {
  color: white;
  font-size: 80px;
}

.space {
  margin-top: 20px;
  margin-left: 100px;
  margin-bottom: 30px;
}

.space1 {
  margin-top: 20px;
  margin-left: 40px;
  margin-bottom: 30px;
}
</style>

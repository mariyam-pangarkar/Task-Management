<style scoped>
.title1 {
  font-size: 22px;
  font-weight: bold;
}
.buttonstyle {
  border: 2px solid #a9a9a970;
  border-radius: 4px;
  cursor: pointer;
}
.carddecor:hover {
  background-color: rgb(163 160 155 / 17%);
  border-radius: 4px;
  cursor: pointer;
}
.cardnull {
  border-radius: 4px;
  border: 2px solid #a9a9a970;
}
</style>
<template>
  <div>
    <div class="container py-5">
      <div id="" class="row">
        <div class="col-12 pb-4 title1">Task List</div>
        <div class="col-3">
          <select
            class="form-select py-2 col-12 select"
            v-model="selectedproject"
            @change="getAllTask()"
            aria-label=""
          >
            <option value="" disabled>Select Project</option>
            <option v-for="(row, index) in allproject" :key="index" :value="row.id">
              {{ row.project_name }}
            </option>
          </select>
        </div>
        <div class="col-2 text-left">
          <button class="btn btn-top buttonstyle py-2 px-3" @click="addprojectmodel()">
            <i class="fa fa-plus icon"></i>
            Add Project
          </button>
        </div>
        <div class="col-3 text-left">
          <button class="btn btn-top buttonstyle py-2 px-3" @click="addtaskmodel()">
            <i class="fa fa-plus icon"></i>
            Add Task
          </button>
        </div>
      </div>
      <div class="row pt-5">
        <div class="col-2">No</div>
        <div class="col-8">Task</div>
        <div class="col-1">Edit</div>
        <div class="col-1">Delete</div>
      </div>
      <draggable v-model="alltask" @change="logsection">
        <template v-if="alltask != ''">
          <div
            class="row py-3 carddecor my-3"
            v-for="(row, index) in alltask"
            :key="index"
          >
            <div class="col-2">{{ index + 1 }}</div>
            <div class="col-8">{{ row.name }}</div>
            <div class="col-1" @click="editTask(index)"><i class="fas fa-edit"></i></div>
            <div class="col-1" @click="deleteTask(row.id)">
              <i class="fas fa-trash-alt"></i>
            </div>
          </div>
        </template>
        <template v-else>
          <div class="row py-5 cardnull my-4">
            <div class="col-12 text-center">No Tasks Found</div>
          </div>
        </template>
      </draggable>
    </div>
    <div
      class="modal fade"
      id="addtaskmodal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document" style="padding-top: 100px !important">
        <div class="modal-content">
          <div class="modal-body pt-0 pb-0">
            <div class="row">
              <div class="col-12 pointer py-2">
                <div class="row py-1 justify-content-end px-3">
                  <div class="col-12 title1">Add Task</div>
                  <div class="col-lg-12 py-4">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Task name</label>
                      <input
                        type="name"
                        class="form-control"
                        id="taskname"
                        placeholder="Enter Task name"
                        v-model="taskname"
                      />
                    </div>
                    <label for="exampleInputEmail1">Select Project </label>

                    <select
                      class="form-select py-2 col-12 select"
                      aria-label=""
                      v-model="project_id"
                    >
                      <option value="" disabled>Select Project</option>

                      <option
                        v-for="(row, index) in allproject"
                        :key="index"
                        :value="row.id"
                      >
                        {{ row.project_name }}
                      </option>
                    </select>
                    <div class="col-12 pt-4 pb-2 text-right">
                      <button type="submit" class="btn btn-primary" @click="Submittask()">
                        Submit
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div
      class="modal fade"
      id="edittaskmodal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document" style="padding-top: 100px !important">
        <div class="modal-content">
          <div class="modal-body pt-0 pb-0">
            <div class="row">
              <div class="col-12 pointer py-2">
                <div class="row py-1 justify-content-end px-3">
                  <div class="col-12 title1">Update Task</div>
                  <div class="col-lg-12 py-4">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Task name</label>
                      <input
                        type="name"
                        class="form-control"
                        id="taskname"
                        placeholder="Enter Task name"
                        v-model="selectedTask.name"
                      />
                    </div>
                    <div class="col-12 pt-4 pb-2 text-right">
                      <button type="submit" class="btn btn-primary" @click="updateTask()">
                        Submit
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div
      class="modal fade"
      id="createprojectmodal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document" style="padding-top: 100px !important">
        <div class="modal-content">
          <div class="modal-body pt-0 pb-0">
            <div class="row">
              <div class="col-12 pointer py-2">
                <div class="row py-1 justify-content-end px-3">
                  <div class="col-12 title1">Add Project</div>
                  <div class="col-lg-12 py-4">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Project name</label>
                      <input
                        type="name"
                        class="form-control"
                        id="taskname"
                        placeholder="Enter Project name"
                        v-model="project_name"
                      />
                    </div>
                    <div class="col-12 pt-4 pb-2 text-right">
                      <button
                        type="submit"
                        class="btn btn-primary"
                        @click="Submitproject()"
                      >
                        Submit
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { VueDraggableNext } from "vue-draggable-next";

export default {
  components: {
    draggable: VueDraggableNext,
  },
  data() {
    return {
      taskname: "",
      alltask: [],
      selectedTask: "",
      project_name: "",
      allproject: [],
      project_id: "",
      selectedproject: 1,
    };
  },
  methods: {
    addtaskmodel() {
      $("#addtaskmodal").modal("show");
    },
    Submittask() {
      console.log("hello");
      this.axios
        .post("/api/addtask", {
          taskname: this.taskname,
          project_id: this.project_id,
          headers: {
            accept: "application/json",
            "accepT-language": "eN-Us,en;q=0.8",
          },
        })
        .then((response) => {
          this.getAllTask();
          this.taskname = "";
          this.project_id = "";
          $("#addtaskmodal").modal("hide");
        });
    },
    addprojectmodel() {
      $("#createprojectmodal").modal("show");
    },
    Submitproject() {
      this.axios
        .post("/api/createproject", {
          project_name: this.project_name,
          headers: {
            accept: "application/json",
            "accepT-language": "eN-Us,en;q=0.8",
          },
        })
        .then((response) => {
          this.getprojects();
          this.project_name = "";
          $("#createprojectmodal").modal("hide");
        });
    },
    getprojects() {
      this.axios
        .post("/api/getprojects", {
          headers: {
            accept: "application/json",
            "accepT-language": "eN-Us,en;q=0.8",
          },
        })
        .then((response) => {
          this.allproject = response.data.allproject;
        });
    },
    getAllTask() {
      console.log(this.project_id);
      this.axios
        .post("/api/gettasks", {
          project_id: this.selectedproject,

          headers: {
            accept: "application/json",
            "accepT-language": "eN-Us,en;q=0.8",
          },
        })
        .then((response) => {
          this.alltask = response.data.alltask;
        });
    },
    editTask(index) {
      this.selectedTask = this.alltask[index];
      console.log(this.selectedTask);
      $("#edittaskmodal").modal("show");
    },
    updateTask() {
      this.axios
        .post("/api/updateTask", {
          id: this.selectedTask.id,
          taskname: this.selectedTask.name,
          headers: {
            accept: "application/json",
            "accepT-language": "eN-Us,en;q=0.8",
          },
        })
        .then((response) => {
          $("#edittaskmodal").modal("hide");
          this.getAllTask();
        });
    },
    deleteTask(id) {
      console.log(this.selectedTask.id);
      this.axios
        .post("/api/deleteTask", {
          id: id,
          headers: {
            accept: "application/json",
            "accepT-language": "eN-Us,en;q=0.8",
          },
        })
        .then((response) => {
          this.getAllTask();
        });
    },
    logsection(event) {
      this.axios
        .post("/api/updatedraggable", {
          newOrder: this.alltask,
          headers: {
            accept: "application/json",
            "accepT-language": "eN-Us,en;q=0.8",
          },
        })
        .then((response) => {});
    },
  },
  created() {},

  mounted() {
    console.log("test");
    this.getAllTask();
    this.getprojects();
  },

  updated() {},
};
</script>

<template>
  <div class="container-fluid mt-3">
    <form-component
      :dataStudent="studentSelected"
      :isEditing="editing"
      :getStudents="getStudentsList"
    ></form-component>

    <div class="row">
      <div class="col-md-12 col-sm-12">
        <div class="card" style="min-width: 800px; margin: 0px">
          <div class="card-header bg-dark text-white">Crud de Estudiantes</div>
          <div class="card-body">
            <div class="row my-3">
              <div class="col-12">
                <button
                  class="btn btn-success"
                  @click="addStudent()"
                  data-toggle="modal"
                  data-target="#formModal"
                >
                  Nuevo Estudiante
                </button>
              </div>
            </div>
            <div class="row">
              <div class="col-2 offset-5">
                <div
                  class="spinner-border text-dark"
                  role="status"
                  v-if="loading"
                >
                  <span class="sr-only">Loading...</span>
                </div>
              </div>
            </div>
            <table class="table table-striped table-bordered" v-if="!loading">
              <thead class="thead-dark">
                <tr>
                  <th scope="col">ID</th>
                  <th scope="col">Nombres</th>
                  <th scope="col">Apellidos</th>
                  <th scope="col">Tipo Identificación</th>
                  <th scope="col">Número Identificación</th>
                  <th scope="col">Sexo</th>
                  <th scope="col">Fecha de Nacimiento</th>
                  <th scope="col">Carrera</th>
                  <th scope="col">Acciones</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(item, index) in students" :key="item.id">
                  <th scope="row">{{ index + 1 }}</th>
                  <td>{{ item.nombres }}</td>
                  <td>{{ item.apellidos }}</td>
                  <td>{{ item.tipo_identificacion }}</td>
                  <td>{{ item.nro_identificacion }}</td>
                  <td>{{ item.sexo }}</td>
                  <td>{{ item.fecha_nacimiento }}</td>
                  <td>{{ item.carrera }}</td>
                  <td>
                    <button
                      class="btn btn-warning"
                      @click="editStudent(item)"
                      data-toggle="modal"
                      data-target="#formModal"
                    >
                      Editar
                    </button>
                    <button class="btn btn-danger" @click="deleteStudent(item)">
                      Eliminar
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
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
      studentSelected: {},
      loading: true,
      editing: false,
    };
  },
  methods: {
    editStudent(data) {
      this.studentSelected = data;
      this.editing = true;
    },
    deleteStudent(data) {
      const { id } = data;
      axios
        .delete(`/api/estudiantes/${id}`)
        .then((rta) => {
          this.$toastr.s("Estudiante eliminado con éxito.");
          this.getStudentsList();
        })
        .catch((err) => {
          this.$toastr.e("Error al eliminar el listado de estudiantes.");
        });
    },
    addStudent() {
      this.studentSelected = {};
      this.editing = false;
    },
    getStudentsList() {
      this.loading = true;
      this.editing = false;
      this.resetStudents();
      axios
        .get("/api/estudiantes")
        .then((rta) => {
          this.students = rta.data;
          this.loading = false;
        })
        .catch((err) => {
          this.$toastr.e("Error al cargar el listado de estudiantes.");
        });
    },
    resetStudents() {
      this.students = [];
    },
  },
  mounted() {
    this.getStudentsList();
  },
};
</script>

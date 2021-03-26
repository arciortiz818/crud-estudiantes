<template>
  <div
    class="modal fade"
    id="formModal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="modalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalLabel">
            {{ isEditing ? "Actualizar" : "Crear" }} Estudiante
          </h5>
          <button
            type="button"
            class="close"
            data-dismiss="modal"
            aria-label="Close"
          >
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <b-form @submit="onSubmit">
            <b-form-group
              id="input-group-1"
              label="Nombres"
              label-for="input-nombres"
            >
              <b-form-input
                id="input-nombres"
                v-model="dataStudent.nombres"
                type="text"
                placeholder="Nombres"
                required
              ></b-form-input>
            </b-form-group>
            <b-form-group
              id="input-group21"
              label="Apellidos"
              label-for="input-apellidos"
            >
              <b-form-input
                id="input-apellidos"
                v-model="dataStudent.apellidos"
                type="text"
                placeholder="Apellidos"
                required
              ></b-form-input>
            </b-form-group>
            <b-form-group
              id="input-group-3"
              label="Tipo Identificación"
              label-for="input-tip-iden"
            >
              <b-form-input
                id="input-tip-iden"
                v-model="dataStudent.tipo_identificacion"
                type="text"
                placeholder="Tipo Identificación"
                required
              ></b-form-input>
            </b-form-group>
            <b-form-group
              id="input-group-4"
              label="Número Identificación"
              label-for="input-nro-iden"
            >
              <b-form-input
                id="input-nro-iden"
                v-model="dataStudent.nro_identificacion"
                type="text"
                placeholder="Número Identificación"
                required
              ></b-form-input>
            </b-form-group>
            <b-form-group
              id="input-group-5"
              label="Sexo"
              label-for="input-sexo"
            >
              <b-form-input
                id="input-sexo"
                v-model="dataStudent.sexo"
                type="text"
                placeholder="Sexo"
                required
              ></b-form-input>
            </b-form-group>
            <b-form-group
              id="input-group-6"
              label="Fecha Nacimiento"
              label-for="input-fec-nac"
            >
              <b-form-datepicker
                id="input-fec-nac"
                name="fecha_nacimiento"
                v-model="dataStudent.fecha_nacimiento"
                class="mb-2"
                :max="maxDate"
              ></b-form-datepicker>
            </b-form-group>
            <b-form-group
              id="input-group-7"
              label="Carrera"
              label-for="input-carrera"
            >
              <b-form-input
                id="input-carrera"
                v-model="dataStudent.carrera"
                type="text"
                placeholder="Carrera"
                required
              ></b-form-input>
            </b-form-group>
            <b-form-group class="modal-footer" id="input-group-8">
              <button
                type="button"
                class="btn btn-secondary"
                data-dismiss="modal"
                id="btnCancelModal"
              >
                Cancelar
              </button>
              <button type="submit" class="btn btn-primary" @click="onSubmit">
                Guardar
              </button>
            </b-form-group>
          </b-form>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: {
    isEditing: Boolean,
    dataStudent: Object,
    getStudents: Function,
  },
  data() {
    return {
      maxDate: new Date(),
    };
  },
  methods: {
    onSubmit(event) {
      event.preventDefault();
      if (!this.isFormValid) {
        this.$toastr.w("Debe llenar todos los campos.");
        return;
      }
      if (this.isEditing) {
        this.updateStudent();
      } else {
        this.createStudent();
      }
    },
    updateStudent() {
      const { id, ...student } = this.dataStudent;
      axios
        .put(`/api/estudiantes/${id}`, student)
        .then((rta) => {
          this.$toastr.s("Estudiante actualizado con éxito.");
          document.getElementById("btnCancelModal").click();
          this.getStudents();
        })
        .catch((err) => {
          this.$toastr.e("No se pudo actualizar el estudiante.");
        });
    },
    createStudent() {
      axios
        .post("/api/estudiantes", this.dataStudent)
        .then((rta) => {
          this.$toastr.s("Estudiante creado con éxito.");
          document.getElementById("btnCancelModal").click();
          this.getStudents();
        })
        .catch((err) => {
          this.$toastr.e("No se pudo crear el estudiante.");
        });
    },
  },
  mounted() {},
  computed: {
    isFormValid() {
      return !(
        this.dataStudent.nombres == undefined ||
        this.dataStudent.apellidos == undefined ||
        this.dataStudent.tipo_identificacion == undefined ||
        this.dataStudent.nro_identificacion == undefined ||
        this.dataStudent.sexo == undefined ||
        this.dataStudent.fecha_nacimiento == undefined ||
        this.dataStudent.carrera == undefined ||
        this.dataStudent.nombres == '' ||
        this.dataStudent.apellidos == '' ||
        this.dataStudent.tipo_identificacion == '' ||
        this.dataStudent.nro_identificacion == '' ||
        this.dataStudent.sexo == '' ||
        this.dataStudent.fecha_nacimiento == '' ||
        this.dataStudent.carrera == ''
      );
    },
  },
};
</script>

<template  >
  <div class="container">
    <div class="card mb-4">
      <div class="card-header">
        <i class="fas fa-table mr-1"></i>
        Tabela dos Produtos
        <button type="button" class="btn btn-info" @click.prevent="addProduct">
          <b-icon-plus-circle-fill />
        </button>
      </div>
      <div class="card-body">
          <hr />
          <div class="table-responsive">
            <table id="table-products" class="display nowrap" style="width: 100%">
              <thead>
              <tr>
                <th>Categoria</th>
                <th>Nome</th>
                <th>Foto</th>
                <th>Descrição</th>
                <th>Ações</th>
              </tr>
            </thead>

              <tbody>
                <tr
                  v-for="(product, i) in products"
                  :key="i">
                    <td>{{ product.category_name }}</td>
              <td>{{ product.name }}</td>
              <td>
                <img
                  v-bind:src="itemImageURL(product.image)"
                  width="30"
                  height="30"
                  alt=""
                />
              </td>
              <td>
                {{
                  product.description.length >= 25
                    ? product.description.substring(0, 25) + "..."
                    : product.description
                }}
              </td>
              <td>
                <div class="btn-group" role="group" aria-label="Basic example">
                  <button
                    type="button"
                    class="btn btn-danger"
                    @click.prevent="
                      deleteProduct(product.id, product.image, product.name)
                    "
                  >
                    <b-icon-trash />
                  </button>
                  <button
                    type="button"
                    class="btn btn-info"
                    @click.prevent="editProduct(product.id)"
                  >
                    Editar
                  </button>
                </div>
              </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
    </div>
  </div>
</template>


<script type="text/javascript">
import $ from "jquery";
export default {
  data() {
    return {
      products: [],
      storagePath: "storage/",
      dt: null, // object for  datatable
    };
  },

  methods: {
    getProducts() {
      axios
        .get("api/products")
        .then((response) => {
          console.log(response);
          this.products = response.data.data;
        })
        .catch(function (err) {
          console.log(err);
        });
    },

    itemImageURL(photo) {
      console.log(photo);
      return this.storagePath + String(photo);
    },

    deleteProduct(id, image, name) {
      axios
        .delete("api/product/" + id, { data: { image: image } })
        .then((response) => {
          console.log(response);
          this.getProducts();
          this.$toasted.show(
            "O produto " + "'" + name + "'" + " foi apagado com sucesso!"
          );
        })
        .catch(function (err) {
          console.log(err);
        });
    },
    addProduct() {
      this.$router.push("add-product");
    },
    editProduct(id) {
      localStorage.setItem("id-F-edit", JSON.stringify(id));
      this.$router.push("edit-product");
    },

    showList() {
       axios
        .get("api/products")
        .then((response) => {
          this.products = response.data.data;
          console.log(response)
          this.dt = $("#table-products").DataTable({
            deferRender: true,
            responsive: true,
            order: [[0, "asc"]],
            pagingType: "full_numbers",
            lengthMenu: [
              [15, 25, 50, -1],
              [15, 25, 50, "Todos"],
            ],
            pageLength: 15,
            language: {
              sLoadingRecords:
                "<div class='h1 m- t - xs'><span class='loading'></span></div>",
              sProcessing: "A processar...",
              sEmptyTable: "Não foi encontrado nenhum registo",
              sLengthMenu: "Mostrar _MENU_ registos",
              sZeroRecords: "Não foram encontrados resultados",
              sInfo: "A mostrar de _START_ até _END_ de _TOTAL_ registos",
              sInfoEmpty: "A mostrar de 0 até 0 de 0 registos",
              sInfoFiltered: "(filtrado de _MAX_ registos no total)",
              sInfoPostFix: "",
              sSearch: "Procurar:",
              sUrl: "",
              oPaginate: {
                sFirst: "«",
                sLast: "»",
                sNext: "›",
                sPrevious: "‹",
              },
              oAria: {
                sSortAscending: ": Ordenar colunas de forma ascendente",
                sSortDescending: ": Ordenar colunas de forma descendente",
              },
            },
          });
          
        })
        
        .catch((error) => {
          console.log(error);
        });
    },
  },
  watch: {
    products() {
      this.dt.destroy();
      this.$nextTick(() => {
        this.dt = $("#table-products").DataTable({
          deferRender: true,
          responsive: true,
          order: [[0, "desc"]],
          pagingType: "full_numbers",
          lengthMenu: [
            [15, 25, 50, -1],
            [15, 25, 50, "Todos"],
          ],
          pageLength: 15,
          language: {
            sEmptyTable: "Não foi encontrado nenhum registo",
            sLoadingRecords:
              "<div class='h1 m- t - xs'><span class='loading'></span></div>",
            sProcessing: "A processar...",
            sLengthMenu: "Mostrar _MENU_ registos",
            sZeroRecords: "Não foram encontrados resultados",
            sInfo: "A mostrar de _START_ até _END_ de _TOTAL_ registos",
            sInfoEmpty: "A mostrar de 0 até 0 de 0 registos",
            sInfoFiltered: "(filtrado de _MAX_ registos no total)",
            sInfoPostFix: "",
            sSearch: "Procurar:",
            sUrl: "",
            oPaginate: {
              sFirst: "«",
              sLast: "»",
              sNext: "›",
              sPrevious: "‹",
            },
            oAria: {
              sSortAscending: ": Ordenar colunas de forma ascendente",
              sSortDescending: ": Ordenar colunas de forma descendente",
            },
          },
        });
      });
    },
  },
  mounted() {
    this.showList();
  },
};
</script>
<style  scoped >
.card {
  margin-top: 120px;
}

.card-header {
  display: flex;
  justify-content: space-between;
}
</style>










<template>
  <div>
    <h2>BackOffice - Transações</h2>

    <div style="margin-bottom: 10px;">
      <label>Filtrar por estado:</label>
      <select v-model="filtroEstado" @change="fetchTransacoes">
        <option value="">Todos</option>
        <option value="pendente">Pendente</option>
        <option value="pago">Pago</option>
        <option value="falhado">Falhado</option>
      </select>
    </div>

    <table border="1" cellspacing="0" cellpadding="5">
      <thead>
        <tr>
          <th>Cliente</th>
          <th>Telefone</th>
          <th>Valor</th>
          <th>Estado</th>
          <th>Data</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="t in transacoes" :key="t.id">
          <td>{{ t.nome_cliente }}</td>
          <td>{{ t.telefone }}</td>
          <td>{{ t.valor }}</td>
          <td>{{ t.estado }}</td>
          <td>{{ new Date(t.created_at).toLocaleString() }}</td>
        </tr>
      </tbody>
    </table>

    <p v-if="transacoes.length === 0">Nenhuma transação encontrada.</p>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "BackOffice",
  data() {
    return {
      transacoes: [],
      filtroEstado: "",
    };
  },
  mounted() {
    this.fetchTransacoes();
  },
  methods: {
    async fetchTransacoes() {
      try {
        let url = "/api/transacoes";
        if (this.filtroEstado) {
          url += `?estado=${this.filtroEstado}`;
        }
        const res = await axios.get(url);
        this.transacoes = res.data;
      } catch (error) {
        console.error("Erro ao buscar transações:", error);
        this.transacoes = [];
      }
    },
  },
};
</script>

<style scoped>
h2 {
  color: darkgreen;
}
table {
  width: 100%;
  border-collapse: collapse;
}
th {
  background-color: #f2f2f2;
}
td, th {
  padding: 8px;
  text-align: left;
}
select {
  padding: 5px;
}
</style>
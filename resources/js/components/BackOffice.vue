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
          <td>{{ t.nome_cliente || '---' }}</td>
          <td>{{ t.telefone || '---' }}</td>
          <td>{{ formatValor(t.valor) }}</td>
          <td>{{ t.estado || '---' }}</td>
          <td>{{ formatData(t.created_at) }}</td>
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
        console.log("Dados recebidos:", res.data); // debug
        this.transacoes = res.data;
      } catch (error) {
        console.error("Erro ao buscar transações:", error);
        this.transacoes = [];
      }
    },
    formatData(data) {
      if (!data) return "Sem data";
      const d = new Date(data);
      return isNaN(d) ? "Data inválida" : d.toLocaleString();
    },
    formatValor(valor) {
      if (!valor && valor !== 0) return "---";
      return Number(valor).toLocaleString("pt-BR", { style: "currency", currency: "BRL" });
    },
  },
};
</script>

<style scoped>
h2 {
  color: #2c3e50;
  text-align: center;
}
table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 10px;
}
th {
  background-color: #ecf0f1;
  padding: 8px;
}
td {
  padding: 8px;
  border-bottom: 1px solid #bdc3c7;
}
select {
  padding: 5px;
  border-radius: 4px;
}
</style>
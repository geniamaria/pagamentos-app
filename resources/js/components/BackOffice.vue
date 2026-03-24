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
    let url = "http://127.0.0.1:8000/api/transacoes";
    if (this.filtroEstado) {
      url += `?estado=${this.filtroEstado}`;
    }

    const res = await axios.get(url);
    console.log("Dados recebidos:", res.data);

    let data = res.data;
    if (typeof res.data === "string") {
      data = JSON.parse(res.data);
    }

    if (Array.isArray(data)) {
      this.transacoes = data.map(t => ({
        ...t,
        created_at: t.created_at ? new Date(t.created_at) : null
      }));
    } else {
      console.error("O retorno da API ainda não é um array:", data);
      this.transacoes = [];
    }
  } catch (error) {
    console.error("Erro ao buscar transações:", error);
    this.transacoes = [];
  }
},
    formatData(data) {
      if (!data) return "Sem data";
      return isNaN(data.getTime()) ? "Data inválida" : data.toLocaleString();
    },
    formatValor(valor) {
      if (valor === null || valor === undefined) return "---";
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
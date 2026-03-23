<template>
  <div>
     <form @submit.prevent="submitPagamento">
    <h2>Formulário de Pagamento</h2>

    <div>
      <label>Nome completo *</label>
      <input type="text" v-model="nome_cliente" />
      <span v-if="errors.nome_cliente" class="error">{{ errors.nome_cliente }}</span>
    </div>

    <div>
      <label>Número de telefone *</label>
      <input type="tel" v-model="telefone" />
      <span v-if="errors.telefone" class="error">{{ errors.telefone }}</span>
    </div>

    <div>
      <label>Valor do pagamento *</label>
      <input type="number" v-model="valor" />
      <span v-if="errors.valor" class="error">{{ errors.valor }}</span>
    </div>

    <div>
      <label>Descrição (opcional)</label>
      <textarea v-model="descricao"></textarea>
    </div>

    <button type="submit">Enviar Pagamento</button>
  </form>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "PagamentoForm",
  data() {
    return {
      nome_cliente: "",
      telefone: "",
      valor: null,
      descricao: "",
      errors: {},
    };
  },
  methods: {
    validate() {
      this.errors = {};
      if (!this.nome_cliente) this.errors.nome_cliente = "Nome é obrigatório";
      if (!this.telefone || !/^\+?\d{9,15}$/.test(this.telefone)) {
        this.errors.telefone = "Telefone inválido";
      }
      if (!this.valor || this.valor <= 0) this.errors.valor = "Valor deve ser maior que 0";
      return Object.keys(this.errors).length === 0;
    },
    async submitPagamento() {
      if (!this.validate()) return;

      try {
        await axios.post("/api/transacoes", {
          nome_cliente: this.nome_cliente,
          telefone: this.telefone,
          valor: this.valor,
          descricao: this.descricao,
        });
        alert("Pagamento registrado com sucesso!");
        this.nome_cliente = "";
        this.telefone = "";
        this.valor = null;
        this.descricao = "";
      } catch (error) {
        console.error(error);
        alert("Erro ao registrar pagamento.");
      }
    },
  },
};
</script>

<style scoped>

form {
  max-width: 500px;
  margin: 30px auto;
  padding: 10px;
  display: flex;
  flex-direction: column;
  gap: 15px;
  background-color: #f9f9f9; 
  border-radius: 9px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

h2 {
  color: #2c3e50; 
  text-align: center;
  margin-bottom: 10px;
  font-size: 15px;
}

label {
  font-weight: 400;
  color: #34495e; 
  margin-bottom: 4px;
}

input, textarea, select {
  padding: 8px;
  font-size: 16px;
  border: 1px solid #ccc;
  border-radius: 6px;
  transition: border-color 0.3s, box-shadow 0.3s;
}

input:focus, textarea:focus, select:focus {
  border-color: #3498db; 
  box-shadow: 0 0 5px rgba(52, 152, 219, 0.3);
  outline: none;
}


.error {
  color: #e74c3c; 
  font-size: 10px;
  font-weight: 300;
  margin-top: 2px;
}


button {
  padding: 8px;
  font-size: 16px;
  font-weight: bold;
  color: #fff;
  background-color: #3498db; 
  border: none;
  border-radius: 6px;
  cursor: pointer;
  transition: background-color 0.3s, transform 0.2s;
}

button:hover {
  background-color: #2980b9; 
  transform: translateY(-2px);
}

button:active {
  background-color: #1c5980; 
  transform: translateY(0);
}

textarea {
  resize: vertical;
  min-height: 80px;
}
</style>
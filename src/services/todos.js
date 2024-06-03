import api from "./api.js";

export default class Todos {
    static async create(description) {
        try {
            const response = await api('/todo', { method: 'POST', body: JSON.stringify({ description: description }) });
            return response;
        } catch (e) {
            console.log(e);
            return null;
        }
    }

    static async getById(id) {
        try {
            const response = await api('/todo/' + id, { method: 'GET' });
            return response.data;
        } catch (e) {
            console.log(e);
        }
    }

    static async getAll() {
        try {
            const response = await api('/todo');
            return response.data;
        } catch (e) {
            console.log(e);
        }

    }

    static async updateStatusById(id, completed) {
        try {
            const response = await api('/todo/' + id, { method: 'PUT', body: JSON.stringify({ completed: completed }) });
            return response;
        } catch (e) {
            console.log(e);
            return null;
        }

    }

    static async deleteById(id) {
        try {
            return await api('/todo/' + id, { method: 'DELETE' });
        } catch (e) {
            console.log(e);
        }
    }
}
import config from "./config.js";

class Auth {
    constructor() {
        this.token = localStorage.getItem(config.AUTH_ACCESS_TOKEN) || null;
    }

    async login(credentials) {
        const response = await fetch(`${config.BASE_URL}/login`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(credentials),
        });

        const data = await response.json();

        if (response.ok) {
            this.token = data.token;
            localStorage.setItem(config.AUTH_ACCESS_TOKEN, data.token);
            return data;
        } else {
            throw new Error(data.message);
        }
    }

    async reg(credentials) {
        const response = await fetch(`${config.BASE_URL}/register`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(credentials),
        });

        const data = await response.json();

        if (!response.ok) {
            throw new Error(data.message);
        }

        return data;
    }

    async me() {
        if (!this.token) {
            return { ok: false };
        }

        const response = await fetch(`${config.BASE_URL}/me`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${this.token}`,
            },
        });

        if (response.ok) {
            const data = await response.json();
            return { ok: true, data };
        } else {
            return { ok: false };
        }
    }
}

export default new Auth();



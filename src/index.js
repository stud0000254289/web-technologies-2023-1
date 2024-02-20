function calculatePizza() {
    const pizzaType = document.getElementById('pizza-type').value;
    const pizzaSize = document.getElementById('pizza-size').value;
    const mozzarella = document.getElementById('mozzarella').checked;
    const cheeseCrust = document.getElementById('cheese-crust').checked;
    const cheddarParmesan = document.getElementById('cheddar-parmesan').checked;

    const pizza = new Pizza(pizzaType, pizzaSize);

    if (mozzarella) {
        pizza.addTopping('Сливочная моцарелла');
    }
    if (cheeseCrust) {
        pizza.addTopping('Сырный борт');
    }
    if (cheddarParmesan) {
        pizza.addTopping('Чедер и Пармезан');
    }

    const price = pizza.calculatePrice();
    const calories = pizza.calculateCalories();

    document.getElementById('price').innerText = `Цена: ${price} рублей`;
    document.getElementById('calories').innerText = `Калорийность: ${calories} Ккал`;
}

class Pizza {
    constructor(type, size) {
        this.type = type;
        this.size = size;
        this.toppings = [];
        this.prices = {
            'Маленькая': 100,
            'Большая': 200,
            'Сливочная моцарелла': 50,
            'Сырный борт': this.size === 'Маленькая' ? 150 : 300,
            'Чедер и Пармезан': this.size === 'Маленькая' ? 150 : 300
        };
        this.calories = {
            'Маленькая': 100,
            'Большая': 200,
            'Сливочная моцарелла': 20,
            'Сырный борт': 50,
            'Чедер и Пармезан': 50
        };
        this.basePrice = {
            'Маргарита': 500,
            'Пепперони': 800,
            'Баварская': 700
        };
        this.baseCalories = {
            'Маргарита': 300,
            'Пепперони': 400,
            'Баварская': 450
        };
    }

    addTopping(topping) {
        this.toppings.push(topping);
    }

    calculatePrice() {
        let price = this.basePrice[this.type] + this.prices[this.size];
        for (const topping of this.toppings) {
            price += this.prices[topping];
        }
        return price;
    }

    calculateCalories() {
        let calories = this.baseCalories[this.type] + this.calories[this.size];
        for (const topping of this.toppings) {
            calories += this.calories[topping];
        }
        return calories;
    }
}


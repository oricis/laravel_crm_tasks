console.log('"vendor/ironwoods/Storage.js"'); // HACK:

/**
 * Class to handle LocalStorage
 *
 * Moisés Alcocer, 2019
 * contacto@ironwoods.es
 */

class Storage
{

    clear()
    {
        window.localStorage.clear();
    }

    get(key)
    {
        const storedData = window.localStorage.getItem(key);

        const value = (typeof storedData != 'undefined'
            && storedData != 'undefined'
            && storedData)
            ? JSON.parse('' + storedData)
            : '';

        return value;
    }

    has(key)
    {
        return (window.localStorage.getItem(key));
    }

    set(key, value)
    {
        value = JSON.stringify(value);

        window.localStorage.setItem(key, value);
    }

    unset(key)
    {
        window.localStorage.removeItem(key);
    }
}

const storage = new Storage();

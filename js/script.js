async function handleSearchInput() {
    const query = document.getElementById('search-box').value.trim();
    const dropdown = document.getElementById('dropdown');

    if (query.length === 0) {
        dropdown.innerHTML = '';
        return;
    }

    try {
        const response = await fetch('autocomplete.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ input: query }),
        });

        const result = await response.json();
        if (result.data) {
            dropdown.innerHTML = result.data.map(suggestion => `
                <div class="dropdown-item" onclick="handleSuggestionClick('${suggestion.description}')">
                    ${suggestion.description}
                </div>
            `).join('');
        } else {
            dropdown.innerHTML = '';
        }
    } catch (error) {
        console.error('Error fetching autocomplete suggestions:', error);
    }
}

function handleSuggestionClick(description) {
    document.getElementById('search-box').value = description;
    document.getElementById('dropdown').innerHTML = '';
}

{{ $location['country'] }} <span class="text-gray-600">({{ implode(', ', array_filter([$location['province'], $location['country_code']], fn ($item) => !empty($item))) }})</span>

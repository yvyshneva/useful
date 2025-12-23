hours = float(input("Enter the number of hours: "))

working_days = int(hours // 8)
remaining_hours = round(hours % 8)

units = (
    f"{working_days}d" if working_days else None,
    f"{remaining_hours}h" if remaining_hours else None,
)

print(f"{hours}h -> {' '.join(filter(None, units))} of working time")

# Example usage:
# If the user inputs 26.5, the output will be:
# 26.5h -> 3d 2h of working time

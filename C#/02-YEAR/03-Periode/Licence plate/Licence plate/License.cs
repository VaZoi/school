namespace Licence_plate;
internal class LicenseOfCar
{
    public LicenseOfCar(string licenseNumber)
    {
        var parts = licenseNumber.Split("-", StringSplitOptions.RemoveEmptyEntries);
        if (licenseNumber.Length != 8 && parts.Length != 3 && parts[0]?.Length != 3 && parts[1]?.Length != 2 && parts[2]?.Length != 1)
        {
            throw new Exception("Invalid license");
        }

        foreach(var part in parts)
        {
            ValidatePart(part);
        }

        FirstPart = parts[0];
        MiddlePart = parts[1];
        LastPart = parts[2];

        LicenseNumberCar = licenseNumber;
    }

    private void ValidatePart(string part)
    {
        throw new NotImplementedException();
    }

    public const string ValidLetters = "GHJKLNPRSTXZ";
    public string? LastPart { get; set; }
    public string? MiddlePart { get; set; }
    public string? FirstPart { get; set; }
    public string LicenseNumberCar { get; set; }
    public override string ToString() => $"{FirstPart}-{MiddlePart}-{LastPart}";
}
